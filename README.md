# Paint IT

## Opis strony
Strona Internetowa poświęcona artystom. Dzięki niej artyści mogą pokazać światu swoje obrazy lub inną twórczość kreatywną.

| Wordpress | 5.x.x |
|-|-|

# Zaplecze technologiczne
## Front-end
### CSS
* [Bootstrap 4 Documentation](https://getbootstrap.com/docs/4.1/getting-started/introduction/)
* [RFS - Responsive Font Sizes](https://github.com/twbs/rfs)
* [SCSS (BEM)](http://getbem.com/)

### JavaScript
* [jQuery Documentation](https://api.jquery.com/)
* [JavaScript Cookie](https://github.com/js-cookie/js-cookie)
* [Lightbox2](https://lokeshdhakar.com/projects/lightbox2/)
* [SweetAlert2](https://sweetalert2.github.io/)
* [typed.js](https://github.com/mattboldt/typed.js/)

## Back-end
* [Wordpress Documentation](https://codex.wordpress.org/)

## Standardy programistyczne
**SCSS**
Należy zainstalować wtyczkę [StyleLint](https://marketplace.visualstudio.com/items?itemName=stylelint.vscode-stylelint).
Plik konfiguracyjny reguł: *.stylelintrc* (nie należy go modyfikować - domyślnie wtyczka powinna prawidłowo sprawdzać reguły).

**JavaScript**
Należy zainstalować wtyczkę [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint).
Plik konfiguracyjny reguł: *.eslintrc* (nie należy go modyfikować - domyślnie wtyczka powinna prawidłowo sprawdzać reguły).

*Dodatkowa instalacja*
`npm install -g eslint`

**PHP**
Należy zainstalować wtyczkę [phpcs](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs).
Plik konfiguracyjny reguł: *phpcs.xml* (nie należy go modyfikować - domyślnie wtyczka powinna prawidłowo sprawdzać reguły).

Standard dla reguł: [Inpsyde PHP Coding Standards](https://github.com/inpsyde/php-coding-standards) (PSR1, PSR2, PSR12, Neutron Standard, WordPress Coding Standard, PHPCompatibility, Generic Rules - wszystkie reguły funkcjonują z małymi wyjątkami i wykluczeniami).

*Dodatkowa instalacja*
`composer require inpsyde/php-coding-standards --dev` (wymagany Composer w wersji 1 => `composer self-update --1`)

## Generowanie dokumentacji
**SCSS**
npm install sassdoc -g

run this in PowerShell command :(be sure to run as administrator)
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned
https://docs.microsoft.com/en-us/powershell/module/microsoft.powershell.core/about/about_execution_policies?view=powershell-7

sassdoc site/wp-content/themes/main/_src/scss

**JS**
jsdoc -c jsdoc.json

## Wersjonowanie
Używam [wersjonowania semantycznego](https://semver.org/lang/pl/) dla oznaczania wersji funkcji.
Dla numeru wersji MAJOR.MINOR.PATCH, zwiększaj:
* MAJOR, gdy dokonujesz zmian niekompatybilnych z API,
* MINOR, gdy dodajesz nową funkcjonalność, która jest kompatybilna z poprzednimi wersjami,
* PATCH, gdy naprawiasz błąd nie zrywając kompatybilności z poprzednimi wersjami.

## Instalacja
[...]

## Gulp
- `npm run watch` - watcher
- `npm run sync` - browsersync
- `npm run dev` - build developer version
- `npm run prod` - build production version
- `npm run zip` - pack site to .zip in bundled folder
- `npm run lang` - generate translation files

## Autorzy
* **Patryk Szulc** - *Initial work*
* **Michalina Szymczak** - *Initial work*
* **Damian Zabłocki** - *Initial work*
* **Dawid Szczygielski** - *Initial work*

## Dodatkowe uwagi
- [...]

------------------------------

## WP DEBUG like a boss
```
Zapisywanie loga do pliku wp-content/debug.log

wp-config.php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
!in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) ? define('WP_DEBUG_DISPLAY', false) : define('WP_DEBUG_DISPLAY', true);
define('SCRIPT_DEBUG', true);
define('SAVEQUERIES', true);

Polecam używać LOG:
PastaMedia()->log(string/array);
```
