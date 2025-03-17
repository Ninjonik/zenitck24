        <?php require_once("layout/header.php") ?>
        <header class="h-screen w-full flex flex-col bg-[url('images/hero-header-bg.png')]">
            <div class="w-full h-full flex justify-center items-center flex-col md:flex-row gap-16">
                <img src="images/home.png" class="block md:hidden mt-16 w-80" alt="Domov ZenDeliver">
                <div class="flex flex-col gap-2 justify-center items-center md:items-start md:justify-start">
                    <h2 class="text-5xl">Spoľahlivý <br /> poskytovateľ <br /> <span class="font-bold">kuriérskych služieb.</span></h2>
                    <h3 class="md:text-2xl">Vaše zásielky doručíme bezpečne až do vášho domova a v primeranom čase.</h3>
                    <a href="send_package.php" class="mt-6 btn-primary w-36">Poslať zásielku</a>
                </div>
                <img src="images/home.png" class="hidden md:block" alt="Domov ZenDeliver">
            </div>
        </header>
        <section class="flex flex-col justify-center items-center w-full gap-2">
            <h4 class="text-primary font-bold">Naše služby</h4>
            <h3 class="font-bold">Špeciálne vyvinuté pre vás</h3>
            <div class="flex flex-col md:flex-row gap-6 w-full mt-4">
                <div class="bg-white rounded-lg shadow-md flex flex-col gap-2 p-8 justify-center items-center">
                    <img src="images/services-1.svg" alt="ZenBox" class="h-16 w-16">
                    <h4 class="font-bold">ZenBox</h4>
                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci amet, molestiae ipsam est ad doloremque eligendi necessitatibus ipsa maxime esse! Dolorem unde repellendus omnis repudiandae officia minus non ut inventore!</span>
                    <ol class="flex flex-col ml-8 list-disc marker:text-primary justify-start items-start w-full ">
                        <li>Listy</li>
                        <li>Balíky</li>
                        <li>Nadrozmerný tovar</li>
                    </ol>
                    <button class="mt-6 btn-secondary w-full">Zisti viac</button>
                </div>
                <div class="bg-white rounded-lg shadow-md flex flex-col gap-2 p-8 justify-center items-center">
                    <img src="images/services-1.svg" alt="ZenBox" class="h-16 w-16">
                    <h4 class="font-bold">ZenBox</h4>
                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci amet, molestiae ipsam est ad doloremque eligendi necessitatibus ipsa maxime esse! Dolorem unde repellendus omnis repudiandae officia minus non ut inventore!</span>
                    <ol class="flex flex-col ml-8 list-disc marker:text-primary justify-start items-start w-full ">
                        <li>Listy</li>
                        <li>Balíky</li>
                        <li>Nadrozmerný tovar</li>
                    </ol>
                    <button class="mt-6 btn-primary w-full">Zisti viac</button>
                </div>
                <div class="bg-white rounded-lg shadow-md flex flex-col gap-2 p-8 justify-center items-center">
                    <img src="images/services-1.svg" alt="ZenBox" class="h-16 w-16">
                    <h4 class="font-bold">ZenBox</h4>
                    <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci amet, molestiae ipsam est ad doloremque eligendi necessitatibus ipsa maxime esse! Dolorem unde repellendus omnis repudiandae officia minus non ut inventore!</span>
                    <ol class="flex flex-col ml-8 list-disc marker:text-primary justify-start items-start w-full ">
                        <li>Listy</li>
                        <li>Balíky</li>
                        <li>Nadrozmerný tovar</li>
                    </ol>
                    <button class="mt-6 btn-secondary w-full">Zisti viac</button>
                </div>
            </div>
        </section>
        <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 justify-evenly gap-2 w-full mt-16">
            <?php 

                $stmt = mysqli_execute_query($db, "SELECT * FROM awards ORDER BY poradie ASC;");
                $rows = $stmt->fetch_all(MYSQLI_ASSOC);

                foreach($rows as $row){
                    echo '
                        <div class="flex flex-col gap-2 text-center justify-center items-center">
                            <img src="'.$row["obrazok"].'" alt="'.$row["nazov"].'">
                            <h2 class="text-primary font-extrabold">'.$row["hodnota"].'+</h3>
                            <h4 class="font-semibold">'.$row["nazov"].'</h4>
                        </div>
                    ';
                }

            ?>
        </section>
        <section class="flex flex-col md:flex-row justify-center items-center gap-12">
            <div class="flex flex-col gap-2 w-full justify-center">
                <img src="images/contact.png" alt="Kontaktujte nás" class="w-80">
                <h5 class="text-primary font-bold">Potrebujete poradiť?</h3>
                <h2 class="font-bold">Budeme vás kontaktovať v čo najkratšom čase.</h2>
                <h5 class="text-links">Pondelok až Piatok, od 8:00 do 18:30</h4>
            </div>
            <div class="flex flex-col gap-2 w-full">
                <input type="text" placeholder="Vaše meno">
                <input type="email" placeholder="E-mailová adresa">
                <textarea name="message" id="" placeholder="Message"></textarea>
                <button class="mt-2 btn-primary w-full">Odoslať správu</button>
            </div>
        </section>
    </main>
    <?php require_once("layout/footer.php") ?>
  </body>
</html>