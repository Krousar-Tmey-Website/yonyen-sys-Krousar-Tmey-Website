import os

d = r'c:\Users\USER\Desktop\yonyen-sys-Krousar-Tmey-Website\resources\views\admin'
count = 0
files_with_translation = []

for r, _, fs in os.walk(d):
    for f in fs:
        if f.endswith('.blade.php'):
            path = os.path.join(r, f)
            with open(path, 'r', encoding='utf-8') as file:
                if "x-show=\"lang === 'en'\"" in file.read():
                    count += 1
                    files_with_translation.append(path)

print(f"Total forms with translation fields: {count}")
# Let's print the first few files to see
for f in files_with_translation[:5]:
    print(f)
