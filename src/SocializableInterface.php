<?php

namespace Audiogram\Socializer;

interface SocializableInterface
{
    /**
     * Transform some model attributes and return a Socializable instance.
     *
     * @return Socializable
     */
    public function toSocializable(): Socializable;
}
