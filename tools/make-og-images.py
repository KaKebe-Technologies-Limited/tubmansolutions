"""
Generate 1200x630 Open Graph (share) images for every page -> assets/img/og/*.png

Usage (from the project folder):
    C:/xampp/php/php.exe tools/og-data.php > tools/og-data.json
    python tools/make-og-images.py [--photo path/to/real-installation-photo.jpg]

--photo  optional: a real CCTV installation photo used as the right-hand visual
         (recommended once you have your own photos; stock photos are not used).
Requires Pillow (pip install pillow).
"""
import json, os, sys
from PIL import Image, ImageDraw, ImageFont, ImageFilter

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
OUT = os.path.join(ROOT, 'assets', 'img', 'og')
W, H = 1200, 630
NAVY, NAVY2, BLUE, BLUE_LIGHT, MUTED = (6, 23, 58), (11, 35, 80), (10, 74, 163), (91, 147, 255), (197, 208, 230)

FONT_DIRS = [r'C:\Windows\Fonts', '/usr/share/fonts/truetype/dejavu', '/Library/Fonts']


def font(names, size, variation=None):
    for d in FONT_DIRS:
        for n in names:
            p = os.path.join(d, n)
            if os.path.exists(p):
                f = ImageFont.truetype(p, size)
                if variation:
                    try:
                        f.set_variation_by_name(variation)
                    except Exception:
                        pass
                return f
    return ImageFont.load_default()


def F_HEAD(s): return font(['bahnschrift.ttf', 'segoeuib.ttf', 'arialbd.ttf', 'DejaVuSans-Bold.ttf'], s, 'Bold')
def F_SEMI(s): return font(['bahnschrift.ttf', 'seguisb.ttf', 'arialbd.ttf', 'DejaVuSans-Bold.ttf'], s, 'SemiBold')
def F_TEXT(s): return font(['segoeui.ttf', 'arial.ttf', 'DejaVuSans.ttf'], s)


def wrap(draw, text, fnt, max_w):
    words, lines, cur = text.split(), [], ''
    for w in words:
        t = (cur + ' ' + w).strip()
        if draw.textlength(t, font=fnt) <= max_w:
            cur = t
        else:
            if cur:
                lines.append(cur)
            cur = w
    if cur:
        lines.append(cur)
    return lines


def spaced(draw, xy, text, fnt, fill, spacing):
    x, y = xy
    for ch in text:
        draw.text((x, y), ch, font=fnt, fill=fill)
        x += draw.textlength(ch, font=fnt) + spacing
    return x


def background(photo=None):
    img = Image.new('RGB', (W, H), NAVY)
    px = img.load()
    for y in range(H):              # diagonal navy -> blue gradient
        for x in range(0, W, 2):
            t = min(1, max(0, (x / W) * 0.65 + (y / H) * 0.35))
            c = tuple(int(NAVY[i] + (NAVY2[i] - NAVY[i]) * t) for i in range(3))
            px[x, y] = c
            if x + 1 < W:
                px[x + 1, y] = c
    glow = Image.new('L', (W, H), 0)
    ImageDraw.Draw(glow).ellipse((700, 20, 1260, 600), fill=150)
    glow = glow.filter(ImageFilter.GaussianBlur(120))
    img = Image.composite(Image.new('RGB', (W, H), BLUE), img, glow)
    d = ImageDraw.Draw(img, 'RGBA')
    for x in range(0, W, 48):       # subtle tech grid
        d.line([(x, 0), (x, H)], fill=(255, 255, 255, 10))
    for y in range(0, H, 48):
        d.line([(0, y), (W, y)], fill=(255, 255, 255, 10))

    if photo and os.path.exists(photo):   # real photo on the right, faded into the navy
        ph = Image.open(photo).convert('RGB')
        pw, phh = 560, H
        r = max(pw / ph.width, phh / ph.height)
        ph = ph.resize((int(ph.width * r) + 1, int(ph.height * r) + 1), Image.LANCZOS)
        ph = ph.crop(((ph.width - pw) // 2, (ph.height - phh) // 2, (ph.width - pw) // 2 + pw, (ph.height - phh) // 2 + phh))
        mask = Image.new('L', (pw, phh), 0)
        mp = mask.load()
        for x in range(pw):
            a = int(255 * min(1, x / 220))
            for y in range(phh):
                mp[x, y] = a
        img.paste(ph, (W - pw, 0), mask)
        d = ImageDraw.Draw(img, 'RGBA')
        d.rectangle((W - pw, 0, W, H), fill=(6, 23, 58, 70))
    else:                            # brand visual: rings + logo mark
        cx, cy = 940, 300
        for r, a in ((250, 26), (190, 40), (130, 60)):
            d.ellipse((cx - r, cy - r, cx + r, cy + r), outline=(91, 147, 255, a), width=3)
        mark = Image.open(os.path.join(ROOT, 'assets', 'img', 'logo-mark-light.png')).convert('RGBA')
        mark = mark.resize((230, 230), Image.LANCZOS)
        img.paste(mark, (cx - 115, cy - 115), mark)
        for (x, y, s) in ((1110, 90, 14), (1128, 72, 10), (1092, 70, 8), (770, 520, 12), (752, 540, 8)):
            d.rectangle((x, y, x + s, y + s), fill=(91, 147, 255, 200))
    return img


def render(page, brand, photo=None):
    img = background(photo)
    d = ImageDraw.Draw(img, 'RGBA')
    L = 64

    # logo lockup (top-left)
    mark = Image.open(os.path.join(ROOT, 'assets', 'img', 'logo-mark-light.png')).convert('RGBA').resize((64, 64), Image.LANCZOS)
    img.paste(mark, (L, 56), mark)
    d.text((L + 78, 58), 'H.TUBMAN', font=F_HEAD(34), fill='white')
    spaced(d, (L + 80, 99), 'SOLUTIONS LIMITED', F_TEXT(14), MUTED, 4)

    # eyebrow
    y = 178
    d.rectangle((L, y + 11, L + 34, y + 13), fill=BLUE_LIGHT)
    spaced(d, (L + 46, y), page['eyebrow'], F_SEMI(20), BLUE_LIGHT, 3)

    # headline (auto-size to fit 3 lines in 660px)
    max_w = 660 if not photo else 600
    # prefer a 2-line headline; fall back to 3 lines at a smaller size
    for size, max_lines in ((64, 2), (58, 2), (54, 2), (50, 3), (46, 3), (42, 3)):
        hf = F_HEAD(size)
        lines = wrap(d, page['headline'], hf, max_w)
        if len(lines) <= max_lines:
            break
    y = 222
    for ln in lines[:3]:
        d.text((L, y), ln, font=hf, fill='white')
        y += int(size * 1.12)

    # sub line
    y += 10
    sf = F_TEXT(24)
    for ln in wrap(d, page['sub'], sf, max_w)[:2]:
        d.text((L, y), ln, font=sf, fill=MUTED)
        y += 32

    # chips
    cy = max(486, y + 14)
    x = L
    cf = F_SEMI(19)
    for c in page['chips']:
        tw = d.textlength(c, font=cf)
        if x + tw + 36 > (L + max_w + 40):
            break
        d.rounded_rectangle((x, cy, x + tw + 32, cy + 40), radius=20, fill=(255, 255, 255, 22), outline=(91, 147, 255, 150), width=2)
        d.text((x + 16, cy + 8), c, font=cf, fill='white')
        x += tw + 44

    # contact bar
    bar_y = 550
    d.rounded_rectangle((L, bar_y, L + 700, bar_y + 44), radius=22, fill=BLUE)
    text = 'Call %s  ·  WhatsApp %s  ·  %s' % (brand['phones'][0], brand['whatsapp'], brand['domain'])
    tf = F_SEMI(19)
    tw = d.textlength(text, font=tf)
    d.text((L + (700 - tw) / 2, bar_y + 10), text, font=tf, fill='white')
    return img


def main():
    photo = None
    if '--photo' in sys.argv:
        photo = sys.argv[sys.argv.index('--photo') + 1]
    data = json.load(open(os.path.join(ROOT, 'tools', 'og-data.json'), encoding='utf-8-sig'))
    os.makedirs(OUT, exist_ok=True)
    for page in data['pages']:
        img = render(page, data['brand'], photo)
        path = os.path.join(OUT, page['file'])
        img.save(path, 'PNG', optimize=True)
        print('%-45s %6.1f KB' % (page['file'], os.path.getsize(path) / 1024))


if __name__ == '__main__':
    main()
