# PamutLabor_probafeladat

A feladat sikeresen elkészült, extra részekből egyedül egyet csináltam meg időhiány miatt de erre kicsit később részletesen kitérek.
Összeségében olyan 5 óra alatt készülhetett el az elejétől a végéig (ebbe beleszámoltam a stackoverflow böngészést és a kaja szünetet is).


### Problémák és megoldások
- Viszonylag nagyon sikerült elakadnom azon hogy látszólag hiába írtam meg hibátlanul azt hogyha változik az e-mail vagy a kapcsolattartó neve akkor csak és kizárólag akkor frissült a tábla ha az email is változott. Ha csak az név változott de az email nem akkor nem történt változás. 
  - Kiderült hogy jobban megnézve az adatbázist az emailen megszorítás van. 

- Ugyan AJAX-ot nem igazán használtam még, gondoltam egyszerű lesz beintegrálni.
  - Viszonylag egyszerűen sikerült is megoldani , sőt még animáció is van rajta.

- Rögtön az index.php oldalon amikor kilistázok mindent akkor egy hatalmas query-t csináltam ami (szinte) mindent táblát összeköt.
  - Ennek egészen biztos vagyok hogy v an elegánsabb megoldása, de ez már csak simogatás kérdése. 


### Extra
- [x] Legalább a törlés funkció aszinkron módon, az oldal újratöltése nélkül történjen.
- [ ] 10 projekt jelenjen meg egy oldalon, afeletti projektszám esetén lapozó legyen.
- [ ] A projekteket lehessen státusz szerint szűrni.
- [ ] A rendszer egy projekt módosításakor küldjön automatikus e-mailt a projekthez tartozó kapcsolató
      számára, amelyben szerepelnek a megváltozott adatok (de csak azok).
- [x] Ha a feladatot publikus GitHub Repository linkként küldöd vissza (duh.)


