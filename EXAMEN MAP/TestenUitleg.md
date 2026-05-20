# Testoverzicht — Voor het Testrapport
**Project:** Grytsje Suze — Portfolio & Admin Panel

---

## Hoe werken de tests?

De tests draaien automatisch via PHPUnit. Elke test maakt verbinding met een aparte testdatabase (`grytsje_suze_test`), voert een actie uit, en controleert of het resultaat klopt. Voor elke test wordt de database leeggemaakt zodat tests elkaar nooit beinvloeden.

Uitvoeren met:
```
vendor/bin/phpunit tests/FunctionsTest.php --testdox
```

---

## Overzicht per test

### T01 — It returns a valid id when a bag is created
**Wat wordt getest:** Een nieuwe tas aanmaken in de database.
**Hoe:** `createTas()` wordt aangeroepen met een naam, beschrijving, afbeeldingspad en kleurcode.
**Verwacht resultaat:** De functie geeft een ID terug dat groter is dan 0. Dit bewijst dat de tas daadwerkelijk opgeslagen is.

---

### T02 — It stores all bag fields correctly when created
**Wat wordt getest:** Of alle velden van een tas correct worden opgeslagen.
**Hoe:** Een tas wordt aangemaakt met specifieke waarden voor alle velden. Daarna wordt de tas opgehaald uit de database.
**Verwacht resultaat:** Elk veld in de database komt exact overeen met wat is ingevoerd.

---

### T03 — It returns null when a bag does not exist
**Wat wordt getest:** Wat er gebeurt als je een tas probeert op te halen die niet bestaat.
**Hoe:** `getTasById()` wordt aangeroepen met ID 99999, een ID dat zeker niet bestaat.
**Verwacht resultaat:** De functie geeft `null` terug in plaats van een foutmelding.

---

### T04 — It returns all bags in the overview
**Wat wordt getest:** Of het overzicht alle tassen correct teruggeeft.
**Hoe:** Er worden 3 tassen aangemaakt, daarna wordt `getAllTassen()` aangeroepen.
**Verwacht resultaat:** De functie geeft een lijst terug met precies 3 items.

---

### T05 — It returns an empty overview when no bags exist
**Wat wordt getest:** Of het overzicht correct werkt als er geen tassen zijn.
**Hoe:** `getAllTassen()` wordt aangeroepen op een lege database.
**Verwacht resultaat:** De functie geeft een lege lijst terug, geen foutmelding.

---

### T06 — It updates the bag name correctly
**Wat wordt getest:** Of het bewerken van een tas werkt.
**Hoe:** Een tas wordt aangemaakt met naam "Oude Naam". Daarna wordt `updateTas()` aangeroepen met "Nieuwe Naam". Tot slot wordt de tas opnieuw opgehaald.
**Verwacht resultaat:** De naam in de database is bijgewerkt naar "Nieuwe Naam".

---

### T07 — It returns false when updating a bag that does not exist
**Wat wordt getest:** Wat er gebeurt als je een niet-bestaande tas probeert te bewerken.
**Hoe:** `updateTas()` wordt aangeroepen met ID 99999.
**Verwacht resultaat:** De functie geeft `false` terug.

---

### T08 — It deletes a bag and returns the image path
**Wat wordt getest:** Of het verwijderen van een tas correct werkt.
**Hoe:** Een tas wordt aangemaakt met een afbeeldingspad. Daarna wordt `deleteTas()` aangeroepen.
**Verwacht resultaat:** De functie geeft het afbeeldingspad terug (zodat het bestand ook van de server verwijderd kan worden), en de tas bestaat daarna niet meer in de database.

---

### T09 — It returns null when deleting a bag that does not exist
**Wat wordt getest:** Wat er gebeurt als je een niet-bestaande tas probeert te verwijderen.
**Hoe:** `deleteTas()` wordt aangeroepen met ID 99999.
**Verwacht resultaat:** De functie geeft `null` terug in plaats van een foutmelding.

---

### T10 — It stores the admin password as a hash and not as plaintext
**Wat wordt getest:** Of wachtwoorden veilig worden opgeslagen.
**Hoe:** Een admin wordt aangemaakt met wachtwoord "geheim123". Daarna wordt het wachtwoord direct uit de database opgehaald.
**Verwacht resultaat:** Het opgeslagen wachtwoord is niet leesbaar als tekst, maar `password_verify()` bevestigt wel dat het het juiste wachtwoord is.

---

### T11 — It returns the user when login credentials are correct
**Wat wordt getest:** Of inloggen werkt met de juiste gegevens.
**Hoe:** Een admin wordt aangemaakt. Daarna wordt `loginUser()` aangeroepen met het juiste e-mailadres en wachtwoord.
**Verwacht resultaat:** De functie geeft de gebruikersdata terug, inclusief het e-mailadres.

---

### T12 — It returns null when login credentials are incorrect
**Wat wordt getest:** Of inloggen correct geblokkeerd wordt bij een verkeerd wachtwoord.
**Hoe:** Een admin wordt aangemaakt. Daarna wordt `loginUser()` aangeroepen met een verkeerd wachtwoord.
**Verwacht resultaat:** De functie geeft `null` terug — de gebruiker krijgt geen toegang.

---

### T13 — It deletes an admin but protects the owner
**Wat wordt getest:** Of de beveiliging werkt die voorkomt dat een owner-account verwijderd wordt.
**Hoe:** Er worden een admin en een owner aangemaakt. `deleteUser()` wordt voor allebei aangeroepen.
**Verwacht resultaat:** De admin wordt succesvol verwijderd (`true`), maar de owner blijft staan (`false`).

---

### T14 — It returns white text on dark background colors
**Wat wordt getest:** Of de contrastberekening correct witte tekst kiest op donkere achtergronden.
**Hoe:** `getContrastColor()` wordt aangeroepen met donkere kleuren zoals zwart en donker paars.
**Verwacht resultaat:** De functie geeft steeds `text-white` terug.

---

### T15 — It returns black text on light background colors
**Wat wordt getest:** Of de contrastberekening correct zwarte tekst kiest op lichte achtergronden.
**Hoe:** `getContrastColor()` wordt aangeroepen met lichte kleuren zoals wit en geel.
**Verwacht resultaat:** De functie geeft steeds `text-black` terug.

---

### T16 — It calculates contrast color correctly without a hash prefix
**Wat wordt getest:** Of de contrastberekening ook werkt als de kleurcode geen `#` heeft.
**Hoe:** `getContrastColor()` wordt aangeroepen met `ffffff` en `000000` (zonder hekje).
**Verwacht resultaat:** De uitkomst is hetzelfde als met hekje — `text-black` resp. `text-white`.

---

## Eindresultaat

```
OK (16 tests, 31 assertions)
```

Alle 16 tests slagen. De 31 assertions zijn de individuele controles binnen de tests — sommige tests controleren meerdere dingen tegelijk (T02 controleert bijvoorbeeld 6 velden in een keer).