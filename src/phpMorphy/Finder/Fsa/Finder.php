<?php
/*
* This file is part of phpMorphy project
*
* Copyright (c) 2007-2012 Kamaev Vladimir <heromantor@users.sourceforge.net>
*
*     This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU Lesser General Public
* License as published by the Free Software Foundation; either
* version 2 of the License, or (at your option) any later version.
*
*     This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
* Lesser General Public License for more details.
*
*     You should have received a copy of the GNU Lesser General Public
* License along with this library; if not, write to the
* Free Software Foundation, Inc., 59 Temple Place - Suite 330,
* Boston, MA 02111-1307, USA.
*/



class phpMorphy_Finder_Fsa_Finder extends phpMorphy_Finder_FinderAbstract
{
    protected
        $fsa,
        $root;

    function __construct(phpMorphy_Fsa_FsaInterface $fsa, phpMorphy_AnnotDecoder_AnnotDecoderInterface $annotDecoder) {
        parent::__construct($annotDecoder);

        $this->fsa = $fsa;
        $this->root = $this->fsa->getRootTrans();
    }

    /**
     * @return phpMorphy_Fsa_FsaInterface
     */
    function getFsa() {
        return $this->fsa;
    }

    /**
     * @param string $word
     * @return array|false
     */
    protected function doFindWord($word) {
        $result = $this->fsa->walk($this->root, $word);

        if(!$result['result'] || null === $result['annot']) {
            return false;
        }

        return $result['annot'];
    }
}
