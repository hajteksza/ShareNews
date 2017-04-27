<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($_GET['action'] == "equal") {
        echo "Wprowadzone hasła nie są takie same. Proszę wprowadzić dwa takie same hasła. <a href = 'index.php'> Proszę powrócić do formularza 
    rejestracji </a>";
    } elseif ($_GET['action'] == "email") {
        echo "Wystąpił błąd podczas rejestracji. Prawdopodobnie twój email znajduje się już w naszej bazie danych. <a href = 'index.php'> Proszę powrócić do poprzedniej strony </a>";
    } elseif ($_GET['action'] == "login") {
        echo "Wprowadzono nieprawidłową nazwę użytkownika lub hasło <a href = 'index.php'> Proszę powrócić do poprzedniej strony </a>";
    } elseif ($_GET['action'] == "not") {
        echo "Nie wprowadzono wszystkich danych do formularza <a href = 'index.php'> Proszę powrócić do poprzedniej strony </a>";
    }
}
