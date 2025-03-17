<?php 

    require_once("layout/header.php"); 

    $country = $_POST["country"] ?? "";
    $width = $_POST["width"] ?? "";
    $height = $_POST["height"] ?? "";
    $length = $_POST["length"] ?? "";
    $receiver_name = $_POST["receiver_name"] ?? "";
    $receiver_company = $_POST["receiver_company"] ?? "";
    $receiver_phone = $_POST["receiver_phone"] ?? "";
    $receiver_email = $_POST["receiver_email"] ?? "";
    $receiver_city = $_POST["receiver_city"] ?? "";
    $receiver_zipcode = $_POST["receiver_zipcode"] ?? "";
    $receiver_street = $_POST["receiver_street"] ?? "";
    $receiver_number = $_POST["receiver_number"] ?? "";
    $sender_name = $_POST["sender_name"] ?? "";
    $sender_country = $_POST["sender_country"] ?? "SK";
    $sender_phone = $_POST["sender_phone"] ?? "";
    $sender_email = $_POST["sender_email"] ?? "";
    $sender_city = $_POST["sender_city"] ?? "";
    $sender_zipcode = $_POST["sender_zipcode"] ?? "";
    $sender_street = $_POST["sender_street"] ?? "";
    $sender_number = $_POST["sender_number"] ?? "";
    $price = 0;

    function handleSubmit(){
        global $db, $error, $success;

        $country = $_POST["country"];
        $width = $_POST["width"];
        $height = $_POST["height"];
        $length = $_POST["length"];

        $receiver_name = $_POST["receiver_name"];
        $receiver_company = $_POST["receiver_company"];
        $receiver_phone = $_POST["receiver_phone"];
        $receiver_email = $_POST["receiver_email"];
        $receiver_city = $_POST["receiver_city"];
        $receiver_zipcode = $_POST["receiver_zipcode"];
        $receiver_street = $_POST["receiver_street"];
        $receiver_number = $_POST["receiver_number"];

        $sender_name = $_POST["sender_name"];
        $sender_country = $_POST["sender_country"] ?? "-";
        $sender_phone = $_POST["sender_phone"];
        $sender_email = $_POST["sender_email"];
        $sender_city = $_POST["sender_city"];
        $sender_zipcode = $_POST["sender_zipcode"];
        $sender_street = $_POST["sender_street"];
        $sender_number = $_POST["sender_number"];

        function isAnyEmpty(...$args) {
            foreach ($args as $arg) {
                if (empty($arg)) {
                    return true;
                }
            }
            return false;
        }

        if(isAnyEmpty(
            $country, $width, $height, $length, 
            $receiver_name, $receiver_company, $receiver_phone, 
            $receiver_email, $receiver_city, $receiver_zipcode, 
            $receiver_street, $receiver_number, $sender_name,
            $sender_country, $sender_phone, $sender_email,
            $sender_city, $sender_zipcode, $sender_street,
            $sender_number)
        ){
            echo("a");
            return $error = "Vyplňte prosím všetky polia.";
        }

        // šírka, výška, dĺžka
        if(
            $width < 1 || $height < 1 || $length < 1 
        ){
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        // veľkostná kategória

        $sizeVal = "";
        $prirazkaVal = 0;

        $newObvod = (2*$width + 2*$height + $length);

        if ($newObvod < 70){
            $sizeVal = "XS";
            $prirazkaVal = 5;
        } else if ($newObvod < 95){
            $sizeVal = "S";
            $prirazkaVal = 9;
        } else if ($newObvod < 130){
            $sizeVal = "M";
            $prirazkaVal = 21;
        } else if ($newObvod < 150){
            $sizeVal = "L";
            $prirazkaVal = 15;
        } else if ($newObvod < 250){
            $sizeVal = "XL";
            $prirazkaVal = 18;
        } else {
            $sizeVal = "XXL";
            $prirazkaVal = 30;
        }

        // cena

        $prirazkaCountry = 0;

        switch ($country){
            case "SK":
                $prirazkaCountry = 0;
                break;
            case "CZ":
            case "AT":
            case "HU":
            case "PL":
                $prirazkaCountry = 5;
                break;
            case "DE": 
            case "HR": 
            case "BG":
                $prirazkaCountry = 20;
                break;
        }

        $cena = $prirazkaVal + $prirazkaCountry;

        // meno a priezvisko
        if(
            !preg_match("/^[a-zA-Z +]+$/", $sender_name) ||
            !preg_match("/^[a-zA-Z +]+$/", $receiver_name) ||
            strlen($sender_name) < 5 || strlen($sender_name) > 64 ||
            strlen($receiver_name) < 5 || strlen($receiver_name) > 64
         ){
            echo("a");
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        // spoločnosť
        if(
            strlen($receiver_company) > 64
         ){
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        // krajina
        # EMPTY

        // telefónne číslo
        if(
            !preg_match("/^[0-9()+-]/", $sender_phone) ||
            !preg_match("/^[0-9()+-]/", $receiver_phone) ||
            strlen($sender_phone) < 9 || strlen($sender_phone) > 20 ||
            strlen($receiver_phone) < 9 || strlen($receiver_phone) > 20
         ){
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        // e-mail
        if(!preg_match("/^[a-z0-9@.!-]/", $sender_email) || !preg_match("/^[a-z0-9@.!-]/", $receiver_email)){
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        // mesto
        if(
            !preg_match("/^[a-zA-Z +]/", $sender_city) ||
            !preg_match("/^[a-zA-Z +]/", $receiver_city) ||
            strlen($sender_city) < 3 || strlen($sender_city) > 32 ||
            strlen($receiver_city) < 3 || strlen($receiver_city) > 32
         ){
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        // psč
        if(
            !preg_match("/^[0-9 +]/", $sender_zipcode) ||
            !preg_match("/^[0-9 +]/", $receiver_zipcode) ||
            strlen($sender_zipcode) < 3 || strlen($sender_zipcode) > 8 ||
            strlen($receiver_zipcode) < 3 || strlen($receiver_zipcode) > 8
         ){
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        // ulica
        if(
            !preg_match("/^[a-zA-Z .\/+-]/", $sender_street) ||
            !preg_match("/^[a-zA-Z .\/+-]/", $receiver_street) ||
            strlen($sender_street) < 3 || strlen($sender_street) > 32 ||
            strlen($receiver_street) < 3 || strlen($receiver_street) > 32
         ){
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        // číslo
        if(
            !preg_match("/^[0-9 \/+]/", $sender_number) ||
            !preg_match("/^[0-9 \/+]/", $receiver_number) ||
            $sender_number < 1 || $sender_number > 99999 ||
            $receiver_number < 1 || $receiver_number > 99999
         ){
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            echo("a");
            return $error = "Neplatné údaje";
        }

        $code = rand(100000, 999999);

        $query = "
            INSERT INTO packages (code, size, price, payment_status, transport_status,
            receiver_name, receiver_company, receiver_phone, receiver_email,
            receiver_country, receiver_city, receiver_zipcode, receiver_street,
            receiver_number, sender_name, sender_phone, sender_email, sender_country,
            sender_city, sender_zipcode, sender_street, sender_number) VALUES (
            '$code', '$sizeVal', $cena, 0, 0,
            '$receiver_name', '$receiver_company', '$receiver_phone', '$receiver_email',
            '$sender_country', '$receiver_city', '$receiver_zipcode', '$receiver_street',
            $receiver_number, '$sender_name', $sender_phone, '$sender_email', '$sender_country',
            '$sender_city', '$sender_zipcode', '$sender_street', $sender_number
            )";

        $insertStmt = mysqli_execute_query($db, $query);
        return $success = "Úspešne ste odoslali balík!";
    }

    if(isset($_POST["submit"])){
       $res = handleSubmit();
       if($res === "Neplatné údaje"){
        $error = $res;
       } else {
        $success = $res;
       }

    }

?>
<form method="POST" class="flex flex-col justify-center items-center w-full gap-2 mt-24">
    <h4 class="text-primary font-bold">Pre zákazníkov</h4>
    <h3 class="font-bold">Odoslanie novej zásielky</h3>

    <?php if(isset($error)){
        echo "<h3 class='font-bold text-red-500'>$error</h3>";
    } ?>
    <?php if(isset($success)){
        echo "<h3 class='font-bold text-green-500'>$success</h3>";
    } ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full mt-16">
        <div class="p-16 bg-white rounded-lg flex flex-col gap-4 w-full h-full">
            <h5 class="font-bold text-center">Kam chcete odoslať Váš balík?</h5>
            <label for="country">Vyberte krajinu</label>
            <select name="country" id="country" required>
                <option value="sk">Slovenská Republika</option>
                <option value="cz">Česká Republika</option>
                <option value="at">Rakúsko</option>
                <option value="hu">Maďarsko</option>
                <option value="pl">Poľsko</option>
                <option value="de">Nemecko</option>
                <option value="hr">Chorvátsko</option>
                <option value="bg">Bulharsko</option>
            </select>
            <ol class="flex flex-col gap-2 list-disc marker:text-primary ml-4">
                <li>Poistenie je v cene prepravy do výšky 300€.</li>
                <li>Balíková preprava v rámci Slovenska od 3€.</li>
                <li>Ostatné ceny nájdete v prehľadnom cenníku.</li>
            </ol>
            <button class="btn-secondary">Zobraziť cenník</button>
        </div>
        <div class="p-16 bg-white rounded-lg flex flex-col gap-4 w-full">
            <h5 class="font-bold text-center">Zadajte rozmery Vášho balíka</h5>
            <div class="flex flex-row justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <label for="width">A Šírka</label>
                    <input required class="w-full" step="1" type="number" name="width" id="width" min="1" value="<?php echo($width); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="width">B Výška</label>
                    <input required class="w-full" step="1" type="number" name="height" id="height" min="1" value="<?php echo($height); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="width">C Dĺžka</label>
                    <input required class="w-full" step="1" type="number" name="length" id="length" min="1" max="75" value="<?php echo($length); ?>">
                </div>
            </div>
            <label for="country">Obvod Vášho balíka je <span id="obvod" class="font-bold">150 cm</span></label>
            <div class="flex flex-row border boder-links rounded-md">
                <div class="w-full rounded-l-md rounded-r-none border-r-links p-2">Veľkostná kategória: <span id="size"></span></div>
                <span class="w-12 h-full bg-gray-300 flex justify-center items-center rounded-r-md"><span id="prirazka">0</span>€</span>
            </div>
            <span>Rozmerové obmedzenia</span>
            <ol class="flex flex-col gap-2 list-disc marker:text-primary ml-4">
                <li>Maximálny obvod 300 cm (2x A šírka + 2x B výška * 1x C dĺžka)</li>
                <li>Pre ZenBox je dĺžka balíka maximálne 75cm</li>
            </ol>
            <span class="flex flex-row gap-2">Cena: <input readonly class="p-0 border-none w-16" type="number" step="1" id="price" name="price" min="0" value="<?php echo($price); ?>">€</span>
            <button class="btn-secondary">Zobraziť cenník</button>
        </div>
        <div class="p-16 bg-white rounded-lg flex flex-col gap-4 w-full">
            <h5 class="font-bold text-center">Adresát / Prijímateľ</h5>
                <div class="flex flex-col gap-1">
                    <label for="receiver_name">Meno a priezvisko</label>
                    <input minlength="5" maxlength="64" required class="w-full" type="text" name="receiver_name" id="receiver_name" value="<?php echo($receiver_name); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="receiver_company">Spoločnosť</label>
                    <input maxlength="64" class="w-full" type="text" name="receiver_company" id="receiver_company" value="<?php echo($receiver_company); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="receiver_phone">Telefónne číslo</label>
                    <input required maxlength="20" class="w-full" type="text" name="receiver_phone" id="receiver_phone" value="<?php echo($receiver_phone); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="receiver_email">E-mail</label>
                    <input required class="w-full" type="email" name="receiver_email" id="receiver_email" value="<?php echo($receiver_email); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="receiver_city">Mesto</label>
                    <input required maxlength="32" minlength="3" class="w-full" type="text" name="receiver_city" id="receiver_city" value="<?php echo($receiver_city); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="receiver_zipcode">PSČ</label>
                    <input required minlength="3" maxlength="8" class="w-full" type="text" name="receiver_zipcode" id="receiver_zipcode" value="<?php echo($receiver_zipcode); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="receiver_street">Ulica</label>
                    <input required maxlength="64" class="w-full" type="text" name="receiver_street" id="receiver_street" value="<?php echo($receiver_street); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="receiver_number">Číslo</label>
                    <input required class="w-full" type="text" name="receiver_number" id="receiver_number" value="<?php echo($receiver_number); ?>">
                </div>
        </div>
        <div class="p-16 bg-white rounded-lg flex flex-col gap-4 w-full">
            <h5 class="font-bold text-center">Odosielateľ</h5>
                <div class="flex flex-col gap-1">
                    <label for="sender_name">Meno a priezvisko</label>
                    <input required minlength="5" maxlength="64" class="w-full" type="text" name="sender_name" id="sender_name" value="<?php echo($sender_name); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="sender_country">Štát</label>
                    <input required disabled class="w-full" type="text" name="sender_country" id="sender_country" value="<?php echo($sender_country); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="sender_phone">Telefónne číslo</label>
                    <input required minlength="9" maxlength="20" class="w-full" type="text" name="sender_phone" id="sender_phone" value="<?php echo($sender_phone); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="sender_email">E-mail</label>
                    <input required class="w-full" type="email" name="sender_email" id="sender_email" value="<?php echo($sender_email); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="sender_city">Mesto</label>
                    <input required minlength="3" maxlength="32" class="w-full" type="text" name="sender_city" id="sender_city" value="<?php echo($sender_city); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="sender_zipcode">PSČ</label>
                    <input minlength="3" maxlength="8" required class="w-full" type="text" name="sender_zipcode" id="sender_zipcode" value="<?php echo($sender_zipcode); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="sender_street">Ulica</label>
                    <input required minlength="3" maxlength="64" class="w-full" type="text" name="sender_street" id="sender_street" value="<?php echo($sender_street); ?>">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="sender_number">Číslo</label>
                    <input required class="w-full" type="text" name="sender_number" id="sender_number" value="<?php echo($sender_number); ?>">
                </div>
        </div>
    </div>
<button class="btn-primary w-full mt-8" name="submit" type="submit">Odoslať zásielku</button>
</form>
</main>
<?php require_once("layout/footer.php"); ?>
<script src="js/send_package.js"></script>
</body>
</html>