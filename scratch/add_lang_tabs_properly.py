import os
import re

d = r'c:\Users\USER\Desktop\yonyen-sys-Krousar-Tmey-Website\resources\views\admin'

lang_tabs = """
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>"""

def process_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    if "x-show=\"lang === 'en'\"" not in content:
        return
        
    if "lang-tabs" in content:
        return

    original = content
    
    # We want to find the LAST <div class="flex items-center justify-between..."> that appears BEFORE the first <div x-show="lang === 'en'">
    target = "<div x-show=\"lang === 'en'\">"
    idx = content.find(target)
    
    if idx != -1:
        before_content = content[:idx]
        after_content = content[idx:]
        
        # Find all occurrences of justify-between or similar headers before the target
        # We look for <div class="...justify-between..."> ... </div>
        # Actually it's easier to use a regex to find all such flex containers.
        pattern = re.compile(r'(<div class="[^"]*flex[^"]*justify-between[^"]*">.*?)(</div>)', re.DOTALL)
        
        # We need to find the last one in before_content
        matches = list(pattern.finditer(before_content))
        
        if matches:
            last_match = matches[-1]
            
            # Ensure it's not the main page header. It should be a sub-header (usually containing h3 or h4 or a title)
            # Inject lang_tabs right before its closing </div>
            # However, dotall might match too much if there are nested divs. 
            # A safer way: Find the last '<div class="...justify-between'
            last_div_start = before_content.rfind('justify-between')
            if last_div_start != -1:
                # find the start of that div tag
                div_tag_start = before_content.rfind('<div', 0, last_div_start)
                # Find the matching closing </div> for this div
                # We can just count nested divs, but it's simpler to assume the header is short (less than 1000 chars)
                header_block = before_content[div_tag_start:]
                
                # Let's just find the closing </div> of this specific block.
                # Usually it's just <div class="flex items-center justify-between mb-x"> <h3...>Title</h3> </div>
                # So we can just find the first </div> after the </h3>
                close_div_idx = header_block.find('</div>')
                if close_div_idx != -1:
                    new_header_block = header_block[:close_div_idx] + lang_tabs + "\n                " + header_block[close_div_idx:]
                    new_content = before_content[:div_tag_start] + new_header_block + after_content
                    
                    with open(filepath, 'w', encoding='utf-8') as f:
                        f.write(new_content)
                    print(f"Updated {filepath} in nearest flex header")
                    return
        
        # Fallback: if no justify-between is found, let's wrap the nearest h2, h3, h4, or span with font-semibold
        # Find the last <h[2-4]> or <span class="text-sm font-semibold text-gray-700"> before the target
        header_patterns = [r'<h[2-4][^>]*>.*?</h[2-4]>', r'<span[^>]*font-semibold[^>]*>.*?</span>']
        for p in header_patterns:
            matches = list(re.finditer(p, before_content, re.DOTALL))
            if matches:
                last_match = matches[-1]
                header_str = last_match.group(0)
                
                # Replace this header string with a flex container containing both the header and the lang-tabs
                new_header_str = f'<div class="flex items-center justify-between mb-4">{header_str}{lang_tabs}\n</div>'
                
                new_content = before_content[:last_match.start()] + new_header_str + before_content[last_match.end():] + after_content
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                print(f"Updated {filepath} via fallback wrap")
                return
                
        print(f"Could not find a place to put lang-tabs in {filepath}")

for r, _, fs in os.walk(d):
    for f in fs:
        if f.endswith('.blade.php'):
            process_file(os.path.join(r, f))
