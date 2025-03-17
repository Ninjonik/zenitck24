<?php 

    require_once("libs/db.inc.php");

?>

<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        html {
            font-family: "Roboto", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }
    </style>
    <style type="text/tailwindcss">
        @theme {
          --color-background: #fffefe;
          --color-text: #2F2E41;
          --color-heading: #11111d;
          --color-links: #9291a1;
          --color-footer: #222132;
          --color-text-footer: #f0f4f9;
          --color-primary: #f95c19;
          --color-primary-content: #fffefe;
          --color-primary-border: #f95c19;
        }
        @layer base {
            .btn-primary {
                @apply bg-primary text-primary-content p-2 flex flex-row justify-center items-center gap-2 rounded-sm transition-all ease-in-out hover:text-primary hover:bg-primary-content border-2 border-primary hover:cursor-pointer;
            }
            .btn-secondary {
                @apply bg-primary-content text-primary p-2 flex flex-row justify-center items-center gap-2 rounded-sm transition-all ease-in-out hover:text-primary-content hover:bg-primary border-2 border-primary hover:cursor-pointer;
            }
            h1, h2, h3, h4, h5, h6 {
                @apply text-heading;
            }
            h1 {
                @apply text-5xl;
            }
            h2 {
                @apply text-4xl;
            }
            h3 {
                @apply text-3xl;
            }
            h4 {
                @apply text-2xl;
            }
            h5 {
                @apply text-xl;
            }
            input, textarea, select {
                @apply disabled:bg-gray-300 border border-links p-2 rounded-lg outline-none focus:outline-none transition-all ease-in-out focus:border-primary;
            }
        }
      </style>
  </head>
  <body class="w-screen min-h-screen flex justify-between flex-col gap-2 items-center bg-[#fff4e1]">
    <main class="p-4 md:p-0 md:w-[1480px] flex flex-col justify-center items-center gap-8 bg-[url('images/bg.png')]">

        <nav class="fixed receiver_opacity bg-transparent backdrop-blur-sm w-screen left-0 top-0 flex justify-center items-center h-16">
            <div class="flex flex-row gap-2 justify-between w-full mx-4 top-0 md:w-[1480px] p-4">
                <a href="index.php"><img src="images/logo.png" alt="ZenDeliver Logo" class="w-48"></a>
                <ul class="flex-row gap-8 text-links items-center hidden md:flex">
                    <li><a href="#" class="text-links hover:text-primary transition-all ease-in-out">ZenBox</a></li>
                    <li><a href="#" class="text-links hover:text-primary transition-all ease-in-out">Pre zákazníkov</a></li>
                    <li><a href="#" class="text-links hover:text-primary transition-all ease-in-out">Pre podnikateľov</a></li>
                    <li><a href="#" class="btn-primary">Kontaktujte nás</a></li>
                </ul>
                <div class="flex md:hidden flex-col gap-2 relative items-center justify-center">
                    <button type="button" class="text-2xl hover:pointer rotate-90 hover:scale-125 transition-all ease-in-out duration-300 hover:cursor-pointer" id="collapseButton">|||</button>

                    <ul id="content" class="flex-col gap-8 text-links items-center hidden md:flex absolute top-12 right-4 bg-white border border-primary p-2 rounded-md">
                        <li><a href="#" class="text-links hover:text-primary transition-all ease-in-out">ZenBox</a></li>
                        <li><a href="#" class="text-links hover:text-primary transition-all ease-in-out">Pre zákazníkov</a></li>
                        <li><a href="#" class="text-links hover:text-primary transition-all ease-in-out">Pre podnikateľov</a></li>
                        <li><a href="#" class="btn-primary">Kontaktujte nás</a></li>
                    </ul>
                </div>
            </div>
        </nav>

