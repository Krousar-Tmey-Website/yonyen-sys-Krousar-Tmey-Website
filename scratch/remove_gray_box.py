import os
import re

d = r'c:\Users\USER\Desktop\yonyen-sys-Krousar-Tmey-Website\resources\views\admin'

gray_box_pattern = re.compile(
    r'\n?\s*<div class="flex justify-end mb-4 bg-gray-50 p-2 rounded-xl border border-gray-100">\s*<div class="lang-tabs" title="Toggle editing language \(English / French\)">\s*<button type="button" class="lang-tab" :class="\{ active: lang === \'en\' \}" @click="lang = \'en\'; switchGTLang\(\'en\'\)">EN</button>\s*<button type="button" class="lang-tab" :class="\{ active: lang === \'fr\' \}" @click="lang = \'fr\'; switchGTLang\(\'fr\'\)">FR</button>\s*</div>\s*</div>'
)

lang_tabs = """
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>"""

def remove_gray_box(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    new_content = gray_box_pattern.sub('', content)
    
    if new_content != content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Removed gray box from {filepath}")
        return new_content
    return content

for r, _, fs in os.walk(d):
    for f in fs:
        if f.endswith('.blade.php'):
            remove_gray_box(os.path.join(r, f))
