import os
import re

directories = [
    'core_values',
    'partners',
    'program_page_items',
    'history',
    'history_events',
    'jobs',
    'map-projects',
    'map_projects',
    'campaigns',
    'donations',
    'page-sections'
]

base_path = r'c:\Users\USER\Desktop\yonyen-sys-Krousar-Tmey-Website\resources\views\admin'

translatable_fields = ['title', 'headline', 'description', 'supporting_description', 'short_content', 'detail_content', 'content', 'objective', 'activities', 'testimony_name', 'testimony_story', 'question', 'answer']

lang_tabs = """
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">{HEADER_TEXT}</h3>
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>
"""

def process_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # If it already has lang === 'en', it's already translated
    if "lang === 'en'" in content:
        return

    # Find the form
    if '<form' not in content:
        return

    original = content

    # Add x-data="{ lang: 'en' }" to the container if not there
    # Usually we can add it to the form tag itself or the main container.
    # Let's add it to the <form> tag.
    content = re.sub(r'(<form[^>]*class="[^"]*)(")', r'\1" x-data="{ lang: \'en\' }"', content, count=1)
    if 'x-data' not in content:
        content = re.sub(r'(<form[^>]*)>', r'\1 x-data="{ lang: \'en\' }">', content, count=1)

    # Now we find translatable fields.
    # A typical field is a div containing a label and an input/textarea.
    # We will just do a simple replacement for inputs/textareas named exactly what we want.
    
    for field in translatable_fields:
        # Regex to match the block wrapping the input
        # Typically: <div>...<label...>...</label>...<input name="field"...>...</div>
        # Since HTML varies, we search for name="field"
        
        # Match input or textarea
        pattern = rf'(\s*<div[^>]*>.*?name="{field}"[^>]*>.*?</div>\s*)'
        
        # Wait, the <div> might contain nested divs. Regex is bad for this.
        # Let's search for the label and input individually, or just look for the typical structure.
        
        # Instead, I'll write a manual script for each file if it's too complex.
        pass

if __name__ == "__main__":
    pass
