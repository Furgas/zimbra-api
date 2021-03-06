<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteSystemRetentionPolicy;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Admin\Struct\Policy;
use Zimbra\Enum\CosBy;
use Zimbra\Enum\Type;

/**
 * Testcase class for DeleteSystemRetentionPolicy.
 */
class DeleteSystemRetentionPolicyTest extends ZimbraAdminApiTestCase
{
    public function testDeleteSystemRetentionPolicyRequest()
    {
        $value = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME(), $value);
        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $req = new DeleteSystemRetentionPolicy($policy, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($policy, $req->getPolicy());
        $this->assertSame($cos, $req->getCos());

        $req->setPolicy($policy)
            ->setCos($cos);
        $this->assertSame($policy, $req->getPolicy());
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteSystemRetentionPolicyRequest>'
                . '<policy xmlns="urn:zimbraMail" type="' . Type::SYSTEM()  .'" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</DeleteSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteSystemRetentionPolicyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'policy' => [
                    '_jsns' => 'urn:zimbraMail',
                    'type' => Type::SYSTEM()->value(),
                    'id' => $id,
                    'name' => $name,
                    'lifetime' => $lifetime,
                ],
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteSystemRetentionPolicyApi()
    {
        $value = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME(), $value);
        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $this->api->deleteSystemRetentionPolicy(
            $policy, $cos
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin" xmlns:urn2="urn:zimbraMail">'
                . '<env:Body>'
                    . '<urn1:DeleteSystemRetentionPolicyRequest>'
                        . '<urn2:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:DeleteSystemRetentionPolicyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
