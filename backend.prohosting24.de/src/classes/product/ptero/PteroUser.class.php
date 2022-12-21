<?php



class PteroUser extends Base
{
    private \HCGCloud\Pterodactyl\Pterodactyl $pterodactyl;

    public function __construct($dependencyInjector)
    {
        parent::__construct($dependencyInjector);
        $this->loadAPIClient();
    }

    public function loadAPIClient()
    {
        $this->pterodactyl = new \HCGCloud\Pterodactyl\Pterodactyl($this->dependencyInjector->getConfig()->getconfigvalue("ptero_key"), $this->dependencyInjector->getConfig()->getconfigvalue("ptero_url"));
    }

    public function createUser(User $user)
    {
        $password = random_str(20);
        $user->updatePteroPassword($this->dependencyInjector->getDatabase(), $password);
        return $this->pterodactyl->createUser([
            'email' => $user->getEmail(),
            'username' => str_replace(" ", "",$user->getUsername()),
            'password' => $password,
            'language' => 'en',
            'root_admin' => false,
            'first_name' => $user->getVorname(),
            'last_name' => $user->getNachname(),
            'external_id' => (string)$user->getID()
        ]);
    }

    public function getUser($user)
    {
        try {
            return $this->pterodactyl->userEx($user->getID(), $includes = []);
        } catch(\HCGCloud\Pterodactyl\Exceptions\NotFoundException $e){
            return $this->createUser($user);
        }
    }

    public function changePasswort(User $user)
    {
        $userp = $this->pterodactyl->userEx($user->getID());
        $userp->update([
            'email' => $user->getEmail(),
            'username' => str_replace(" ", "",$user->getUsername()),
            'password' => $user->getPteropassword(),
            'language' => 'en',
            'root_admin' => false,
            'first_name' => $user->getVorname(),
            'last_name' => $user->getNachname(),
            'external_id' => (string)$user->getID()
        ]);
    }
}
