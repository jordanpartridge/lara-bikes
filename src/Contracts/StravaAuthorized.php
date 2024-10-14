<?php

namespace JordanPartridge\LaraBikes\Contracts;

interface  StravaAuthorized
{
    /**
     * Returns whether a user is setup
     *
     * @return bool
     */
    public function authorized() : bool;

    /**
     *  Returns the athlete id of the user if they are authorized
     *
     * @return int|null
     */
    public function getAthleteId(): ?int;

    /**
     *  Returns the client id of the user if they are authorized
     *
     * @return string|null
     */
    public function getClientId(): ?string;

    /**
     *  Returns the client secret of the user if they are authorized
     *
     * @return string|null
     */
    public function getClientSecret(): ?string;

}
