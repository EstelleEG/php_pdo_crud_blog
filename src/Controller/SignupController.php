<?php

namespace App\Controller;

use App\Dao\UserDao;
use App\Model\User;

class SignupController
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }
        //The datas I receive from the form completed by my user
        $args = [
            'pseudo' =>[],
            'email' => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            'pwd' => [],
            'conf_pwd' => []
        ];
        $user_post = filter_input_array(INPUT_POST, $args); 
        //$user_post contains the user's data I get from the completed form (data sent by method post via the form's inputs)

        if (isset($user_post['pseudo']) && isset($user_post['email']) && isset($user_post['pwd']) && isset($user_post['conf_pwd'])) {
            if (empty(trim($user_post['pseudo']))) {
                $error_messages[] = 'Pseudo inexistant';
            }
            if (empty($user_post['email'])) {
                $error_messages[] = 'Email inexistant';
            }
            if (empty(trim($user_post['pwd']))) {
                $error_messages[] = 'Mot de passe inexistant';
            }
            if (empty(trim($user_post['conf_pwd']))) {
                $error_messages[] = 'Confirmation mot de passe inexistant';
            }
            if ($user_post['pwd'] !== $user_post['conf_pwd']) {
                $error_messages[] = 'Les mots de passe ne sont pas identiques';
            }

            if (!isset($error_messages)) {
                $userDao = new UserDao();
                $result = $userDao->getByEmail($user_post['email']);
                //Does it already exist an user with this email in db? 

                if (empty($result)) {
                    //$result is the result of my search made by method 'getByEmail'
                    $user = new User();
                    $user->setPseudo($user_post['pseudo'])
                        ->setEmail($user_post['email'])
                        ->setHashPwd($user_post['pwd']);
                    $userDao->new($user);
                    header('Location: /');
                    die;
                } else {
                    $error_messages[] = 'Email déjà utilisé';
                }
            }
        }
        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'sign', 'signup.html.php']);
    }
}