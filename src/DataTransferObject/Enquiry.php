<?php

namespace App\DataTransferObject

use Sympfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(message="Gib bitte deine Nachricht ein.")
     */
    protected $body;
}