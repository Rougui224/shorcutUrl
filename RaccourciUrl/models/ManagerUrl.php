<?php
    require_once('Manager.php');
    class ManagerUrl extends Manager {
        // Vérifier si l'url existe vraiment
        private function checkUrl($url){
            // Initialiser une session cURL
            $ch = curl_init($url);

            // Configurer les options cURL
            curl_setopt($ch, CURLOPT_NOBODY, true); // Pas besoin de récupérer le contenu
            curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Limite de temps de 5 secondes
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Suivre les redirections
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Désactiver la vérification SSL (non recommandé en production)
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Ne pas afficher directement le résultat
            curl_setopt($ch, CURLOPT_FAILONERROR, true); // Gérer les erreurs HTTP
            
            //Exécuter la requête
            $result = curl_exec($ch);

            // Gérer les erreurs cURL
            if ($result === false) {
                $errorMsg = curl_error($ch);
                curl_close($ch);
                return [
                    'status' => false,
                    'error' => $errorMsg
                ]; // Retourner l'erreur si cURL échoue
            }
              // Vérifier le code de statut HTTP
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Fermer la session cURL
            curl_close($ch);

            // Retourner vrai si le code HTTP est 200 (OK), sinon faux
            return [
                'status' => $httpCode == 200,
                'httpCode' => $httpCode
            ];
        }

        // Créer le raccourcie
        private function createShortcut($url){
            return crypt($url,rand());
        }

        // Envoyer l'url
        public function PostShorcut($url){
            if($this->checkUrl($url)){
                $shortcut = $this->createShortcut($url);
                // ajout de l'url
                $db = $this->connaction();
                $addShorcut = $db->prepare('INSERT INTO links(defaultLink,shortLink) VALUES(?,?) ');
                $addShorcut->execute([$url,$shortcut]);
                // on passe le raccourcie directement dans l'url pour pouvoir le recuperer avec get
                header("location: ./?short=$shortcut");
                exit();
            }else {
                header('location: /?error=true&message= url non valide');
            }
        }

        // rediriger le raccourcie vers l'url normal
        public function redirectShortcut($shortcut){
                // recuperer le raccourcie
                $shortcut = htmlspecialchars($shortcut);

                // verifier qu'il existe une seule fois dans la base de données
                $db = $this->connaction();
                $request = $db->prepare('SELECT COUNT(*) AS numberS FROM links WHERE shortLink = ? ');
                $request->execute([$shortcut]);

                while($result = $request->fetch()){
                    if($result['numberS'] != 1){
                        header('location: /?error=true&message=Adresse url non connue');
                        exit();
                    }
                }

                // Redirection
                $request = $db->prepare('SELECT * FROM links WHERE shortlink = ?');
                $request->execute([$shortcut]);
                while($result = $request->fetch()){
                    header('location: '.$result['defaultLink']);
                    exit();
                }

        }
    }