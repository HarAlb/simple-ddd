<?php

namespace App\Api\Base\Helpers;

use App\Api\Base\Contracts\SlugableInterface;
use Illuminate\Support\Str;

class Helper
{
    public function generateSlug(SlugableInterface $slugableInterface, string $name, ?int $id = null)
    {
        $slug = Str::slug($name);
        $i = 1;
        $similarSlugs = $slugableInterface->getSimilarSlugs($slug, $id);
        while ($similarSlugs->where('slug', $slug)->first()) {
            if ($i === 1) {
                $slug .= '-' . $i;
            } else {
                $slug = preg_replace('@-(\d*)$@', '-' . $i, $slug);
            }
            $i++;
        }

        return $slug;
    }
}
