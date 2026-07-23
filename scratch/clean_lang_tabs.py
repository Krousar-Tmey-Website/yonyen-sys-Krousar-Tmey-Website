import os
import re

d = r'c:\Users\USER\Desktop\yonyen-sys-Krousar-Tmey-Website\resources\views\admin'

def clean_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    original = content

    # Remove different variants of the lang-tabs block
    # Variant 1: Just <div class="lang-tabs"> ... </div>
    pattern1 = re.compile(r'\s*<div class="lang-tabs[^>]*>.*?</div>\s*', re.DOTALL)
    
    # Actually, dotall might eat too much if there are multiple divs inside. 
    # Since we know exactly what's inside (two buttons), let's be specific.
    pattern2 = re.compile(r'[ \t]*<div class="lang-tabs[^>]*>[\s\S]*?<button[^>]*>EN</button>[\s\S]*?<button[^>]*>FR</button>[\s\S]*?</div>\n?')
    content = pattern2.sub('', content)

    # If there are wrappers like <div class="flex justify-end"> or gray boxes left empty, remove them
    content = re.sub(r'[ \t]*<div class="flex justify-end(?: mb-4 bg-gray-50 p-2 rounded-xl border border-gray-100)?">\s*</div>\n?', '', content)
    
    # Also remove {{-- Language toggle --}} comments
    content = re.sub(r'[ \t]*\{\{-- Language toggle --\}\}\n?', '', content)

    if content != original:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Cleaned {filepath}")

for r, _, fs in os.walk(d):
    for f in fs:
        if f.endswith('.blade.php'):
            clean_file(os.path.join(r, f))
