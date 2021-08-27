<?php
    include 'google-drive-api/vendor/autoload.php';
    
    putenv('GOOGLE_APPLICATION_CREDENTIALS=sig2018-216219-597676aaa252.json');

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();

    $client->SetScopes(['https://www.googleapis.com/auth/drive.file']);

    try {
        $services = new Google_Service_Drive($client);
        $file_path = "prueba.png";

        $file = new Google_Service_Drive_DriveFile();
        $file->setName($file_path);

        $file->setParents(array("1pA_CSf78_zc2L0unMVLcHtByGUUJz0da"));
        $file->setDescription('Archivos cargados desde assitencia.quillasoftware.com');

        $file->setMimeType("image/png");

        $result = $services->files->create(
            $file,
            array(
                'data'          => file_get_contents($file_path),
                'mimeType'      => "image/png",
                'uploadType'    => "media"
            )

        );
        print_r($result);
        echo '<a href="https://drive.google.com/open?id='.$result->id.'" target="_blank" >'.$result->name."</a>";

    }
    catch(Google_Service_Exception $gs){
        $mensaje = json_decode($gs->getMessage());
        print_r($mensaje);
        //echo $mensaje->error->message();
    } 
    catch (Exception $e) {
        echo $e->getMessage();
    }

    echo "que onda wey";

?>