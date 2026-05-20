# Planning Verbetervoorstellen
**Project:** Grytsje Suze — Portfolio & Admin Panel

---

> **Hoe gebruik je dit document?**
> Per verbetervoorstel vind je hieronder een blok met:
> - Een korte uitleg wat het voorstel inhoudt en hoe je het aanpakt
> - Een invulregel voor wie het oppakt en wanneer
>
> Vul de `[ ]` checkboxes aan als iets klaar is

---

## VP1 — Frontend testen met Cypress of Playwright

**Wie:** Keyan
**Wanneer:** 1e dag Week 3
**Waarom** Keyan is verantwoordelijk voor de frontend

**Wat houdt het in?**
Momenteel worden alleen de PHP backend functies getest. De frontend (navbar, contactformulier, klikbare afbeeldingen, Instagram-link) is niet getest. Cypress en Playwright zijn tools waarmee je een echte browser automatisch kunt aansturen.

**Hoe pak je dit aan?**
1. Installeer Cypress via `npm install cypress --save-dev`
2. Maak een map `cypress/e2e/` aan in de root
3. Schrijf per pagina een testbestand, bijvoorbeeld `portfolio.cy.js`
4. Draai de tests met `npx cypress open` (visueel) of `npx cypress run` (terminal)

**Aandachtspunten:**
- Zorg dat de lokale server draait voordat je de tests uitvoert
- Test minimaal: navbar links, contactformulier verzenden, afbeeldingen klikken

**Voortgang:**
- [ ] Cypress geinstalleerd
- [ ] Eerste testbestand geschreven
- [ ] Tests draaien zonder fouten

---

## VP2 — Invoervalidatie toevoegen en testen

**Wie:** Nickey
**Wanneer:** 1e dag Week 3
**Waarom** Dit is veiliger, en beter voor de gebruiker (en is ook vergeten door Nickey)

**Wat houdt het in?**
Functies zoals `createTas()` en `createAdmin()` vertrouwen nu volledig op de database voor validatie. Als je een lege naam of ongeldig e-mailadres invoert, vangt de database dat wel op — maar de foutmelding is dan onduidelijk. Beter is om dat al in de PHP functie zelf te controleren.

**Hoe pak je dit aan?**
1. Open `admin/functions.php`
2. Voeg bovenaan elke functie een validatiecheck toe, bijvoorbeeld:
   ```php
   if (empty($naam)) {
       throw new InvalidArgumentException('Naam mag niet leeg zijn.');
   }
   ```
3. Schrijf daarna in `FunctionsTest.php` een test die verwacht dat de exception gegooid wordt:
   ```php
   $this->expectException(InvalidArgumentException::class);
   createTas($this->pdo, '', 'beschrijving', 'foto.jpg', '#000');
   ```

**Aandachtspunten:**
- Valideer minimaal: lege naam, leeg e-mailadres, ongeldig e-mailadres formaat
- Zorg dat bestaande tests blijven slagen na de wijziging

**Voortgang:**
- [ ] Validatie toegevoegd aan `createTas()`
- [ ] Validatie toegevoegd aan `createAdmin()`
- [ ] Nieuwe tests geschreven en slagend

---

## VP3 — Authenticatie testen via auth.php

**Wie:** Nickey
**Wanneer:** Als er tijd over is in week 3, anders 1e dag week 4.
**Waarom** Omdat dit niet heel belangrijk is, gezien Keyan nooit wat aanpast bij de backend.

**Wat houdt het in?**
`auth.php` stuurt niet-ingelogde gebruikers door naar `login.php`. Dit wordt momenteel nergens automatisch getest. Als iemand per ongeluk de sessiecheck verwijdert, merkt niemand dat meteen.

**Hoe pak je dit aan?**
Dit kan op twee manieren:

*Optie A — Via Cypress (makkelijkst):*
1. Navigeer in een Cypress test direct naar `admin/index.php` zonder in te loggen
2. Controleer of je uitkomt op `login.php`

*Optie B — Via PHPUnit met een HTTP client:*
1. Installeer Guzzle: `composer require guzzlehttp/guzzle --dev`
2. Stuur een GET request naar de admin pagina zonder sessie
3. Controleer of de response een redirect naar login bevat

**Aandachtspunten:**
- Optie A is makkelijker als je Cypress toch al installeert voor VP1
- Zorg dat de lokale server bereikbaar is tijdens de test

**Voortgang:**
- [ ] Testmethode gekozen (A of B)
- [ ] Test geschreven
- [ ] Test slaagt

---

## VP4 — Data providers gebruiken in PHPUnit

**Wie:** Nickey
**Wanneer:** laatste dag van week 4
**Waarom** Dit is meer Quality of Life voor de testen, en daarom niet super relevant voor het project zelf.

**Wat houdt het in?**
Tests zoals T14 en T15 testen nu meerdere kleuren in één testmethode. Als één kleur faalt, zie je niet direct welke. Met een Data Provider draait PHPUnit dezelfde test automatisch voor elke kleur apart, met een duidelijk label in de uitslag.

**Hoe pak je dit aan?**
1. Open `tests/FunctionsTest.php`
2. Vervang de bestaande T14/T15 tests door een versie met `#[DataProvider]`:
   ```php
   #[DataProvider('donkereKleuren')]
   public function it_returns_white_text_on_dark_background(string $kleur): void
   {
       $this->assertSame('text-white', getContrastColor($kleur));
   }

   public static function donkereKleuren(): array
   {
       return [
           'zwart'       => ['#000000'],
           'donker blauw'=> ['#1a1a2e'],
           'donker paars'=> ['#3b0764'],
       ];
   }
   ```
3. Draai de tests opnieuw en controleer of elke kleur een eigen regel krijgt in de `--testdox` output

**Aandachtspunten:**
- Vereist PHP 8.1+ en PHPUnit 10+
- Het totaal aantal tests in de uitslag stijgt, dat is normaal

**Voortgang:**
- [ ] Data providers toegevoegd voor T14
- [ ] Data providers toegevoegd voor T15
- [ ] Tests draaien correct

---

## VP5 — CI/CD via GitHub Actions

**Wie:** Keyan
**Wanneer:** Laatste dag week 4
**Waarom** Wederom een Quality of Life feature, omdat het niet vereist is voor het project.

**Wat houdt het in?**
Nu worden de tests handmatig uitgevoerd via de terminal. Met GitHub Actions draaien de tests automatisch bij elke push naar GitHub. Zo ontdek je meteen als nieuwe code iets stuk maakt.

**Hoe pak je dit aan?**
1. Maak in de root van het project de map `.github/workflows/` aan
2. Maak daarin het bestand `tests.yml` met de volgende inhoud:
   ```yaml
   name: Tests

   on: [push, pull_request]

   jobs:
     test:
       runs-on: ubuntu-latest
       services:
         mysql:
           image: mysql:8.0
           env:
             MYSQL_ROOT_PASSWORD: ''
             MYSQL_ALLOW_EMPTY_PASSWORD: yes
             MYSQL_DATABASE: grytsje_suze_test
           ports:
             - 3306:3306
       steps:
         - uses: actions/checkout@v3
         - name: Install dependencies
           run: composer install
         - name: Run tests
           run: vendor/bin/phpunit tests/FunctionsTest.php --testdox
   ```
3. Push naar GitHub en controleer onder het tabblad "Actions" of de tests slagen

**Aandachtspunten:**
- De MySQL service in Actions heeft geen wachtwoord nodig (lege root password)
- Zorg dat de DB constanten in `FunctionsTest.php` overeenkomen met de Actions configuratie

**Voortgang:**
- [ ] `.github/workflows/tests.yml` aangemaakt
- [ ] Eerste push gedaan
- [ ] Actions tabblad toont groene vinkjes