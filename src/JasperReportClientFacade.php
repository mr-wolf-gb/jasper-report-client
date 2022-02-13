<?php

namespace Gaiththewolf\JasperReportClient;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Gaiththewolf\JasperReportClient\Skeleton\SkeletonClass
 */
class JasperReportClientFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jasper-report-client';
    }
}
