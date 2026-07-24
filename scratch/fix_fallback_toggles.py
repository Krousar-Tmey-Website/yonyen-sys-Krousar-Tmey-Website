import os
import re

d = r'c:\Users\USER\Desktop\yonyen-sys-Krousar-Tmey-Website\resources\views\admin'

# The exact fallback block string
fallback_pattern = re.compile(
    r'\s*<div class="flex justify-end w-full mb-3 -mt-2">\s*<div class="lang-tabs" title="Toggle editing language \(English / French\)">\s*<button type="button" class="lang-tab" :class="\{ active: lang === \'en\' \}" @click="lang = \'en\'; switchGTLang\(\'en\'\)">EN</button>\s*<button type="button" class="lang-tab" :class="\{ active: lang === \'fr\' \}" @click="lang = \'fr\'; switchGTLang\(\'fr\'\)">FR</button>\s*</div>\s*</div>',
    re.MULTILINE
)

lang_tabs = """<div class="lang-tabs" title="Toggle editing language (English / French)">
    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
</div>"""

def process_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    original = content
    
    # We find each occurrence of the fallback, remove it, and inject the lang-tabs into the preceding header
    while True:
        match = fallback_pattern.search(content)
        if not match:
            break
            
        before = content[:match.start()]
        after = content[match.end():]
        
        # Search backwards for a header
        # We look for <h3...</h3>, <h2...</h2>, <h4...</h4>, or <span class="...font-bold|font-semibold...">...</span>
        # We want the LAST one in the `before` string.
        # To avoid matching a header that is too far away, we only look at the last 1500 chars.
        search_area = before[-1500:] if len(before) > 1500 else before
        
        # Regex to find the last header tag
        header_patterns = [
            r'<h[2-4][^>]*>.*?</h[2-4]>',
            r'<span[^>]*class="[^"]*(?:font-bold|font-semibold)[^"]*"[^>]*>.*?</span>'
        ]
        
        best_match = None
        for p in header_patterns:
            matches = list(re.finditer(p, search_area, re.DOTALL))
            if matches:
                # We want the absolute latest match across all patterns
                if best_match is None or matches[-1].end() > best_match.end():
                    best_match = matches[-1]
                    
        if best_match:
            header_str = best_match.group(0)
            
            # Check if this header is ALREADY inside a flex items-center justify-between container
            # If so, we can just inject the lang-tabs right before its closing </div>!
            # But the HTML structure is complex. The safest way is to replace the header string entirely
            # with a new flex container that wraps it.
            
            # WAIT: If it's already in a flex container, wrapping it in another might break layout slightly (e.g. double margins), but it's usually fine.
            # Actually, let's just replace it.
            # Some headers might have `mb-4` or `mb-6`. The flex container should take that margin.
            # Let's just do a simple replacement.
            new_header_str = f'<div class="flex items-center justify-between mb-4">{header_str}\n    {lang_tabs}\n</div>'
            
            # If the original header had mb-x, we might get double margins, but it's acceptable for admin.
            
            # Construct the new search_area
            new_search_area = search_area[:best_match.start()] + new_header_str + search_area[best_match.end():]
            
            # Now update `before`
            if len(before) > 1500:
                new_before = before[:-1500] + new_search_area
            else:
                new_before = new_search_area
                
            content = new_before + after
        else:
            # If no header found, we just replace it with the fallback but maybe styled better?
            # Or just leave it. But we must remove the match to avoid infinite loop.
            # Let's just replace it with the same fallback so we don't break it, but we can't do that if it loops.
            # We'll just replace it with a marker temporarily, then change it back.
            content = before + "<!-- NO_HEADER_FOUND -->\n" + fallback_pattern.pattern + after # Wait this will break python.
            # To break the loop, if we fail to find a header, we just raise an error so we know.
            print(f"FAILED to find header in {filepath}")
            return

    if content != original:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Fixed fallback in {filepath}")

for r, _, fs in os.walk(d):
    for f in fs:
        if f.endswith('.blade.php'):
            process_file(os.path.join(r, f))
