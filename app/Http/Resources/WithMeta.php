<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Support\Carbon;

trait WithMeta
{
    /**
     * @inheritDoc.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function with($request)
    {
        $otherMeta = [];

        if (method_exists($this, 'meta')) {
            $otherMeta = $this->meta();
        }

        return [
            'meta' => array_merge(
                $otherMeta,
                [
                    'timestamp' => Carbon::now($tz = config('app.timezone')),
                    'timezone' => $tz,
                ]
            )
        ];
    }
}
