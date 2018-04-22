<?php

namespace App\DataTransferObject;


class Enquiry
{
    /**
     * @Assert\NotBlank(message="Gib bitte einen Namen ein.")
     */
    protected $name;

    /**
     * @Assert\NotBlank(message="Gib bitte eine güötige E-Mail Adresse ein.")
     */
    protected $email;

    /**
     * @Assert\NotBlank(message="Gib bitte einen Betreff ein.")
     * @Assert\Length(max="70", maxMessage="Der Betreff sollte nicht länger als 70 Zeichen sein.")
     */
    protected $subject;

    /**
     * @Assert\Length(min="10", minMessage="Die Nachricht sollte mindestens 10 Zeichen sein.")
     */
    protected $body;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }


}
