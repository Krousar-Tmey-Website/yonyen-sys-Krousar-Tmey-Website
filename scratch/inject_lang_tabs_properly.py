import os
import re

d = r'c:\Users\USER\Desktop\yonyen-sys-Krousar-Tmey-Website\resources\views\admin'

lang_tabs = """
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>"""

fallback_tabs = """
                <div class="flex justify-end w-full mb-3 -mt-2">
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>"""

def inject(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    if "x-show=\"lang === 'en'\"" not in content:
        return
        
    if "lang-tabs" in content:
        return

    # Find all x-show="lang === 'en'"
    idx = content.find("x-show=\"lang === 'en'\"")
    if idx == -1: return
    
    before = content[:idx]
    after = content[idx:]
    
    # Check if there is a justify-between div nearby
    last_justify = before.rfind('justify-between')
    # If the justify-between is within the last 400 chars, let's inject it before its closing </div>
    if last_justify != -1 and (len(before) - last_justify) < 400:
        # find the closing </div> of this justify-between block
        # We can just find the LAST </div> in the `before` string!
        last_div_close = before.rfind('</div>')
        if last_div_close != -1 and last_div_close > last_justify:
            new_before = before[:last_div_close] + lang_tabs + "\n                " + before[last_div_close:]
            new_content = new_before + after
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f"Injected into header of {filepath}")
            return
            
    # Fallback: just insert right before x-show
    # find the start of the <div x-show=...
    div_start = content.rfind('<div', 0, idx)
    if div_start != -1:
        new_content = content[:div_start] + fallback_tabs + "\n" + content[div_start:]
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Injected as fallback in {filepath}")

for r, _, fs in os.walk(d):
    for f in fs:
        if f.endswith('.blade.php'):
            inject(os.path.join(r, f))
