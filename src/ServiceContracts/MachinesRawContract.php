<?php

declare(strict_types=1);

namespace Dedalus\ServiceContracts;

use Dedalus\Core\Contracts\BaseResponse;
use Dedalus\Core\Exceptions\APIException;
use Dedalus\CursorPage;
use Dedalus\Machines\Machine;
use Dedalus\Machines\MachineCreateParams;
use Dedalus\Machines\MachineDeleteParams;
use Dedalus\Machines\MachineGetResponse;
use Dedalus\Machines\MachineListItem;
use Dedalus\Machines\MachineListParams;
use Dedalus\Machines\MachineRetrieveParams;
use Dedalus\Machines\MachineSleepParams;
use Dedalus\Machines\MachineUpdateParams;
use Dedalus\Machines\MachineWakeParams;
use Dedalus\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Dedalus\RequestOptions
 */
interface MachinesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|MachineCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function create(
        array|MachineCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MachineRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<MachineGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        array|MachineRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MachineUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function update(
        array|MachineUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MachineListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorPage<MachineListItem>>
     *
     * @throws APIException
     */
    public function list(
        array|MachineListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MachineDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function delete(
        array|MachineDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MachineSleepParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function sleep(
        array|MachineSleepParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MachineWakeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Machine>
     *
     * @throws APIException
     */
    public function wake(
        array|MachineWakeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
