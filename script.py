from pathlib import Path
path = Path('app/Http/Controllers/MessageController.php')
text = path.read_text()
old = '''        Message::whereIn('id', -

        return back()-, 'Status Story berhasil diperbarui');'''
new = '''        Message::whereIn('id', -

        return redirect()-, 'Status Story berhasil diperbarui');'''
if old not in text: raise SystemExit('pattern not found')
path.write_text(text.replace(old, new, 1))
