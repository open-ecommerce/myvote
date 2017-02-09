<?php

require '../data/evote.php';
require '../data/Dialogue.php';
$evote = new Evote();
session_start();
if (isset($_POST['button'])) {
    if ($_POST['button'] == 'vote') {
        $dialogue = new dialogue();
        $ok = true;
        $ongoingR = $evote->ongoingRound();
        if (!isset($_POST['person'])) {
            $ok = false;
            $dialogue->appendMessage('You need to select an option', 'error');
        } elseif (!$evote->checkRightElection($_POST['person'])) {
            // om någon har en gammal sida uppe och försöker rösta
            $ok = false;
            $dialogue->appendMessage('Please try again', 'error');
        } elseif ($evote->getMaxAlternatives() < count($_POST['person'])) {
            // om någon stänger av javascriptet.
            $ok = false;
            $dialogue->appendMessage('Du får inte välja för många kandidater', 'error');
        }

        if ($_POST['code1'] == '') {
            $ok = false;
            $dialogue->appendMessage('You need to enter your secret voting code', 'error');
        }
        if ($_POST['code2'] == '') {
            $ok = false;
            $dialogue->appendMessage('Du har inte angett någon tillfällig valkod', 'error');
        }
        if (!$ongoingR) {
            $ok = false;
            $dialogue->appendMessage('Valomgången har redan avslutats', 'error');
        }

        if ($ok) {
            $person_id = $_POST['person'];
            $personal_code = $_POST['code1'];
            $current_code = $_POST['code2'];

            if ($evote->vote($person_id, $personal_code, $current_code)) {
                $dialogue->appendMessage('Your vote has being registered', 'success');
            } else {
                $dialogue->appendMessage('Your vote was not registered. This could be because you entered any of the codes wrong or that you have already voted', 'error');
            }
        }

        $_SESSION['message'] = serialize($dialogue);
        header('Location: /vote');
    }
}
