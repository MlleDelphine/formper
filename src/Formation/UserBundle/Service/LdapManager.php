<?php

namespace Formation\UserBundle\Service;

use FR3D\LdapBundle\Ldap\LdapManager as BaseLdapManager;
use FR3D\LdapBundle\Model\LdapUserInterface;


class LdapManager extends BaseLdapManager
{

    protected $baseDn;

    /**
     *
     * @var \FR3D\LdapBundle\Driver\ZendLdapDriver
     */
    protected $driver;
    protected function hydrate(\Symfony\Component\Security\Core\User\UserInterface $user, array $entry)
    {
        parent::hydrate($user, $entry);
        $this->getGroups($entry['uid'][0]);
    }

    protected function getGroups($uid)
    {
        $groups = $this->driver->search($this->baseDn, "(&(memberuid=$uid)(objectclass=posixgroup))");
        foreach($groups as $group){
            //@TODO ajouter les groupes s'ils n'existent pas
        }
    }

    /**
     * @param mixed $baseDn
     */
    public function setBaseDn($baseDn)
    {
        $this->baseDn = $baseDn;
    }


}