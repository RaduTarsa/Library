# Library – Radu Târșa

##	Informatii legate de proiect
S-a dorit realizarea unei biblioteci virtuale unde clientul poate vizualiza si descarca carti in format PDF. Acesta va putea vizualiza informatii precum titlul, autorul, editura publicarii, categoria din care face aceasta parte si va avea un link de descarcare a acesteia.
Cartile si categoriile de carti vor fi introduse in baza de date de catre administrator, acesta avand un cont separat fata de client, cu ajutorul caruia poate adauga, edita sau chiar sterge respectivele carti.

##	Structura proiectului
###	Client
Pe partea de client (browser) vom fi intampinati de o interfata draguta, realizata cu ajutorul bootstrap-ului, iar partea de administrare avand integrata si interfata AdminLTE.
###	Server
Pe partea de server, folosim Laravel 8, un framework PHP, cu care gestionam request-urile userilor in cadrul aplicatiei.

## Tehnologii folosite
Pe partea de front-end folosim bootstrap pentru stilizarea markup-ului, interfata AdminLTE pentru structurarea propriu-zisa a comenzilor adminilor.
Pe partea de back-end folosim Laravel 8, framework in PHP care are la baza MVC, ceea ce ne faciliteaza separarea view-urilor de controllere si modelele bazei de date, iar ca baza de date folosim MySQL.

##	Arhitectura aplicatiei
Aplicatia este impartita in modele, view-uri si controllere pentru a facilita scrierea de cod, acesta fiind dinamic transpus. Avem rutele prestabilite care ne duc catre view-urile dorite cu ajutorul controllerelor aferente. Pe langa returnarea de view-uri, aceste controllere gestioneaza, cu ajutorul modelelor, datele din baza de date.
Fiecare ruta care duce la un view sau la un POST este securizata de catre un middleware custom. Acesta este denumit CheckAdmin si are menirea de a verifica in baza de date daca userul are dreptul de a realiza acea actiune (CREATE, READ, DELETE, UPDATE). Acesta, primeste un parametru stabilit in ruta respectiva, il compara cu setul de drepturi ale utilizatorului care face acea actiune si returneaza true sau false, raspunsul reprezentand daca userului ii este interzis sau nu sa realizeze acel lucru.
Rutele sunt impartite astfel: avem afisarea listei cu carti “/book”, adaugarea de carti “/book/add” si salvarea acestora “book/store”, editarea de carti “/book/save/{id}” si salvarea acestora “/book/update”, dar si stergerea acestora “/book/delete/{id}”; pentru categorii, avem rute asemanatoare, doar ca prefixul va fi, in loc de “/book”, “/book/category”... acesta reprezentand faptul ca ne referim la o “categorie” de “carti”; pentru partea de client avem afisarea cartilor “/book/client” care nu face decat sa afiseze cartile intr-un view pentru vizualizarea lor de catre user, iar apoi descarcarea acestora.
Am creat rolurile de “client” si “admin” cu id-urile 1, respectiv 2, cu drepturile aferente: client->R, iar admin->CRUD. Modul de realizare al tabelelor rights si groups faciliteaza adaugarea de noi clase de administratori in lista de utilizatori, acestia putand sa aiba oricare din drepturile enumerate mai sus.

##	Flow-ul aplicatiei
Vom fi intampinati de o pagina de login/register unde ne putem conecta.
Vom merge catre pagina principala unde vom avea lista de carti pe care le putem descarca.
In cazul in care suntem admini pe aceasta aplicatie, vom fi intampinati de interfata AdminLTE care faciliteaza administrarea aplicatiei
Putem adauga carti noi pe pagina Add Book, unde vom pune un titlu, autor, editor, un fisier PDF cu cartea respectiva si selectam o categorie.
Daca nu avem deja adaugate categorii, putem sa le adaugam cu Add Category.
Dupa ce adaugam o categorie, ulterior o carte, putem sa o editam schimbandu-i oricare dintre acesti parametri, respectiv sa o stergem.
Putem face la fel cu categoriile de carti, acestea fiind in stransa legatura cu cartile (daca stergem o categorie, stergem toate cartile din acea categorie; daca modificam numele acesteia, cartile vor apartine de noua categorie; daca modificam o categorie si ii dam un nume asemanator cu alta categorie, toate cartile vor trece la vechea categorie, adica aceeasi cu cea noua, iar cea noua nu va fi adaugata).

##	Imbunatatiri care pot fi aduse proiectului
Proiectul poate dispune de mai multe functii: adaugare de administratori sau revocarea drepturilor acestora, un profil al fiecarui user, functia de book-unbook la carti specificand cine a imprumutat-o, un timeline cu 5 sau 10 notificari in care se pot pune ultimele 5-10 actiuni realizate e.g. “Ion, Liviu Rebreanu, a fost adaugata la ora 10:34 de catre User15”, etc.

##	Pareri personale
Este o tema de proiect destul de ok.
Integrarea AdminLTE poate aduce probleme daca nu e integrata de la bun inceput.
Realizarea acestei teme se poate face intr-un timp foarte scurt; personal in 4 ore documentandu-ma, iar in altele 8 realizand proiectul.
Utilizarea Laravel 8 m-a pus in dificultate la inceput, nestiind ca a fost actualizata versiunea framework-ului si nerealizand la timp de ce apar unele greseli in sintaxa, chiar daca nu pareau. Dupa citirea noi documentatii am observat ca versiunea 8 aduce un plus la performanta (great improvement), au fost rezolvate multe buguri si multe altele.

##	Pentru rularea proiectului
Am folosit Laravel 8, deci pot aparea conflicte daca este utilizata versiunea 7.
Pentru rulare ne vom crea o baza de date cu userul root, parola “blank” si numele acesteia “library”.
Rulam comanda “php artisan migrate”, iar apoi “php artisan db:seed --class=DefSeeder”, pornim serverul si intram pe aplicatia web realizata.
Se vor adauga 2 fisiere PDF cu numele 1.pdf si 2.pdf in "storage/app/public_html/uploads" pentru a simula cele 2 fisiere PDF de la cartile cu id-urile 1 si 2 adaugate de seeder.
In aplicatie, ne vom conecta cu testuser@gmail.com sau testadmin@gmail.com cu parola password.

##	Referinte
Link-uri utile: https://laravel.com/docs/8.x/
