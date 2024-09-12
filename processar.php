<?php
    include('Banco_dados/config.php');
    if(isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['tmp_name'])){
        $arquivo = new DOMDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);
        $linhas = $arquivo->getElementsByTagName("Row");
        //var_dump($linhas);

        $primeira = true;
        foreach($linhas as $linha){
            if($primeira == false){
                $nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $email = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $email_rec = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                $data_nascimento = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                $nivel = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                $senha = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
                $foto = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
            }
            $primeira = false;
        }
    }
?>