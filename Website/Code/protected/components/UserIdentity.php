<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    /**
     * Authenticates a user, by checking if the username (email addres) password combination exists in the user database.
     * @property integer $id Stores the id of the user if the user exists in the database.
     * @return boolean whether authentication succeeds.
     */
    private $_id;

    public function authenticate()
    {
        /* User provided email and password */
        $email = $this->username;
        $password = $this->password;

        /* Database record of the user with the provided email */
        $record = User::model()->findByAttributes(array('email' => $email));
        if ($record === null)
        { // Username does not exist in the database.
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if (!CPasswordHelper::verifyPassword($password, $record->password))
        { // Username does exist, but user entered wrong password.
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        { // Authentication was succesfull.
            $this->_id = $record->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /**
     * 
     * @return integer id of the user that was authenticated.
     */
    public function getId()
    {
        return $this->_id;
    }

}