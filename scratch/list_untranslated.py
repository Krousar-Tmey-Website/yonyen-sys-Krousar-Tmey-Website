import os

d = r'c:\Users\USER\Desktop\yonyen-sys-Krousar-Tmey-Website\resources\views\admin'

untranslated = []

for r, _, fs in os.walk(d):
    for f in fs:
        if f.endswith('.blade.php'):
            # Skip non-forms like lists or partials unless they contain forms
            if 'index.blade.php' in f or 'create.blade.php' in f or 'edit.blade.php' in f or '_form' in f:
                path = os.path.join(r, f)
                with open(path, 'r', encoding='utf-8') as file:
                    content = file.read()
                    if "x-show=\"lang === 'en'\"" not in content and "switchGTLang" not in content:
                        # Ensure it's actually a form
                        if '<form' in content:
                            untranslated.append(path)

for path in untranslated:
    print(path)
print(f"Total untranslated forms: {len(untranslated)}")
