# Case 6 Bokrecensionsapp i PHP

Med denna sida har du som användare möjlighet att skapa användare för att sedan kunna ladda upp recensioner på böcker och filmer men även kunna göra ändringar och radera. 
Man kan dessutom kolla och läsa andra användares recensioner. 
Det är en perfekt applikation för att ge folk inspiration om böcker och filmer som man kan titta på och få en överblick om vad dem handlar om. 

## lokal installation

Om man vill använda denna webbsida lokalt så behöver man använda sig av Docker Desktop vilket är en application som gör att projekt ser ut på samma sak även fast man använder olika enheter. 
Notera att vissa funktioner behöver sätta på manuellt i din dator för att Docker Desktop ska kunna fungera. 
Detta kan man ta reda på genom att söka upp problemet på Google, Bing eller annan sökmotor.
Man kommer även behöva använda Visual Studio Code för att öppna projektet och sedan köra ett speciellt komando som kommer senare i beskrivningen.

    1. Ladda ner Docker Desktop och starta om datorn
    2. Ladda ner detta reposetory på ett ställa i datorn som du kommer ihåg.
    3. Öppna Visual Studio Code.
    4. För att öppna det nerladdade reposetoritbehöver du klicka på "File" -> "Open folder..." och sedan välj den mapp med reposetorit du laddade ner.
    5. När du har reposetorit öppnat i Visual Studio Code så kan du öppna terminalen genom att använda kortkomandot som är "Ctrl" + "Ö".
    6. Skriv följande komando i terminalen:

    ```bash
    docker-compose up
    ``` 

    7. Efter att du har kört detta komando behöver man låra Docker Desktop ladda in containers, volumes etc. När det är färdigladdat kan ni använda applicationen genom att gå in på "localhost:8088" i valfri browser.
    8. Efter det ska man vara inne på startsidan av applicationen som ska vara redo att användas.


## Användning

För att kunna använda applikationen så måste man registera sig själv med användarnamn och lösenord.
Om man vill ändra användarnamn så finns det möjlighet att göra ett på anvöndarikonen i det högra översta hörnet.
När man väl är inloggad kan man kolla på alla reviews som är uppladdade under "Explore".
Man kan kolla sina egna genom att klicka på "My reviews" där man även har möjlighet att redigera sina reviews ifall man har gjort någon/några.
För att skapa en review klickar man på plusset i mitten där det kommer upp ett formulär med information man behöver skriva i för att skapa recensionen. 

