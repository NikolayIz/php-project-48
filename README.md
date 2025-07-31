### Hexlet tests and linter status:
[![Actions Status](https://github.com/NikolayIz/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/NikolayIz/php-project-48/actions)
### Project Status and Quality
[![CI status (tests and linter)](https://github.com/NikolayIz/php-project-48/actions/workflows/main.yml/badge.svg)](https://github.com/NikolayIz/php-project-48/actions/workflows/main.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=NikolayIz_php-project-48&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=NikolayIz_php-project-48)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=NikolayIz_php-project-48&metric=coverage)](https://sonarcloud.io/summary/new_code?id=NikolayIz_php-project-48)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=NikolayIz_php-project-48&metric=bugs)](https://sonarcloud.io/summary/new_code?id=NikolayIz_php-project-48)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=NikolayIz_php-project-48&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=NikolayIz_php-project-48)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=NikolayIz_php-project-48&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=NikolayIz_php-project-48)

# Gendiff

**Gendiff** — это консольная утилита для сравнения двух конфигурационных файлов.  
Программа показывает различия в удобочитаемом виде: древовидном (по умолчанию), plain-тексте или JSON.

### 🔧 Поддерживаемые форматы входных данных:
- **JSON**
- **YAML / YML**

### 🧰 Возможности:
- Определение различий между файлами с вложенной структурой
- Три режима отображения результата:
  - `stylish` (по умолчанию)
  - `plain`
  - `json`
- Поддержка разных форматов данных
- Удобная CLI-интеграция

## 🚀 Установка

```bash
git clone https://github.com/NikolayIz/php-project-48.git
cd php-project-48
make install

# команда help
gendiff -h

# Сравнение двух файлов
gendiff file1.json file2.json

# Сравнение с указанием формата вывода
gendiff --format plain file1.yml file2.yml
gendiff --format json file1.yml file2.yml

```

### Video about using the program:

[![asciicast](https://asciinema.org/a/x138IPlworN4mKHdcIz3CE3t2.svg)](https://asciinema.org/a/x138IPlworN4mKHdcIz3CE3t2)
