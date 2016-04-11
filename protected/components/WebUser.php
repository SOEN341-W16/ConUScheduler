<?php

class WebUser extends CWebUser
{


    private $_model;   // Store model to not repeat query.
    /**
     * @return string returns user's first name
     */
    public function getFirstName()
    {
        $user = $this->loadUser(Yii::app()->user->userID);
        return $user->firstname;
    }

    /**
     * @return bool returns true if user is an administrator/
     * accessed by Yii::app()->user->isAdmin()
     */
    public function isAdmin()
    {
        $user = $this->loadUser(Yii::app()->user->userID);
        return $user->isAdmin == 1;
    }

    /**
     * @return mixed returns user's net name
     */
    public function getNetName()
    {
        $user = $this->loadUser(Yii::app()->user->userID);
        return $user->netname;
    }

    /**
     * @return string returns user's last name
     */
    public function getLastName()
    {
        $user = $this->loadUser(Yii::app()->user->userID);
        return $user->lastname;
    }

    // Load user model.
    protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=User::model()->findByPk($id);
        }
        return $this->_model;
    }
}