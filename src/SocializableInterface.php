<?php

namespace Audiogram\Socializer;

interface SocializableInterface {

	/**
	 * Transform some model attributes to create a Socializable instance.
	 *
	 * @return Socializable
	 */
	public function toSocializable();
}
