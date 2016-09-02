UPDATE quran_text SET sura_fullarabic = CONCAT(sura_arabic, ' ,آية', REPLACE(sura_fullname, CONCAT('Sura ', sura_name, ', Aya '), ' ')) WHERE id = 1;

UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '1', '١');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '2', '٢');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '3', '٣');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '4', '٤');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '5', '٥');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '6', '٦');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '7', '٧');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '8', '٨');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '9', '٩');
UPDATE quran_text SET sura_fullarabic = REPLACE(sura_fullarabic, '0', '٠');


آية

1-7-a8151194
الآية 1 إلى الآية 7 من سورة الفتح
