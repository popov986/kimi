# Convert translations CSV to Excel .xlsx
# Uses translations_all_en_de.csv (from export_all_translations.php) or translations_en_de.csv
import csv
from openpyxl import Workbook
from pathlib import Path

base = Path(__file__).parent
csv_path = base / "translations_all_en_de.csv"
if not csv_path.exists():
    csv_path = base / "translations_en_de.csv"
xlsx_path = base / (csv_path.stem + ".xlsx")

wb = Workbook()
ws = wb.active
ws.title = "Translations"

with open(csv_path, "r", encoding="utf-8-sig") as f:
    for row in csv.reader(f):
        ws.append(row)

wb.save(xlsx_path)
print(f"Created {xlsx_path}")
