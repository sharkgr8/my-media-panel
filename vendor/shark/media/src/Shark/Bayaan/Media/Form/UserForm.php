<?php  namespace Shark\Bayaan\Media\Form;

use Shark\Bayaan\Services\Validation\ValidableInterface;
use Shark\Bayaan\Media\Repo\MediaInterface;

class MediaForm implements MediaInterface {

    /**
     * @var \Stevemo\Cpanel\Services\Validation\ValidableInterface
     */
    protected $validator;

    /**
     * @var \Stevemo\Cpanel\User\Repo\CpanelUserInterface
     */
    protected $users;

    /**
     * @param ValidableInterface                            $validator
     * @param \Stevemo\Cpanel\User\Repo\CpanelUserInterface $users
     */
    public function __construct(ValidableInterface $validator, CpanelUserInterface $users)
    {
        $this->validator = $validator;
        $this->users = $users;
    }

    /**
     * Validate and create the user
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param array $data
     *
     * @return \StdClass
     */
    public function create(array $data)
    {
        try
        {
            if ( $this->validator->with($data)->passes() )
            {
                $this->users->create($data,$data['activate']);
                return true;
            }
        }
        catch (LoginRequiredException $e)
        {
            $this->validator->add('LoginRequiredException',$e->getMessage());
        }
        catch (PasswordRequiredException $e)
        {
            $this->validator->add('PasswordRequiredException',$e->getMessage());
        }
        catch (UserExistsException $e)
        {
            $this->validator->add('UserExistsException',$e->getMessage());
        }

        return false;
    }

    

    /**
     * Validate and update a existing user
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data)
    {
        try
        {
            if ( $this->validator->with($data)->validForUpdate() )
            {
                $this->users->update($data['id'], $this->validator->getData());
                return true;
            }
        }
        catch (LoginRequiredException $e)
        {
            $this->validator->add('LoginRequiredException',$e->getMessage());
        }
        catch (PasswordRequiredException $e)
        {
            $this->validator->add('PasswordRequiredException',$e->getMessage());
        }
        catch (UserExistsException $e)
        {
            $this->validator->add('UserExistsException',$e->getMessage());
        }

        return false;
    }

    /**
     * Validate and log in a user
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @param array $credentials
     * @param bool  $remember
     *
     * @return bool
     */
    public function login(array $credentials, $remember)
    {
        try
        {
            $this->users->authenticate($credentials,$remember);
            return true;
        }
        catch (LoginRequiredException $e)
        {
            $this->validator->add('LoginRequiredException', $e->getMessage());
        }
        catch (PasswordRequiredException $e)
        {
            $this->validator->add('PasswordRequiredException', $e->getMessage());
        }
        catch (WrongPasswordException $e)
        {
            $this->validator->add('WrongPasswordException', $e->getMessage());
        }
        catch (UserNotActivatedException $e)
        {
            $this->validator->add('UserNotActivatedException', $e->getMessage());
        }
        catch (UserNotFoundException $e)
        {
            $this->validator->add('UserNotFoundException', $e->getMessage());
        }
        catch (UserSuspendedException $e)
        {
            $this->validator->add('UserSuspendedException', $e->getMessage());
        }
        catch (UserBannedException $e)
        {
            $this->validator->add('UserBannedException', $e->getMessage());
        }

        return false;
    }

    /**
     * Get the validation errors
     *
     * @author Steve Montambeault
     * @link   http://stevemo.ca
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }
}