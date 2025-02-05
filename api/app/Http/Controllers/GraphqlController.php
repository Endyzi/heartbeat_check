<?php

namespace App\Http\Controllers;


use Butler\Graphql\Concerns\HandlesGraphqlRequests;
use GraphQL\Type\Schema;
use GraphQL\Language\AST\DocumentNode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * GraphController is needed or recommended in order to use the butler api
 */
class GraphqlController extends Controller
{
    use HandlesGraphqlRequests;
    //this hook is used in api/vendor/glesys/butler-service/src/routes.php 
    //haven't figured out the unauthenticated problem, even if bearer token is created. 
    public function beforeExecutionHook(Schema $schema, DocumentNode $query, string $operationName = null, $variables = null): void
    {
        // check authentication to sanctum
        if (!Auth::guard('sanctum')->check()) {
            abort(401, 'Unauthorized');
        }
    }
}
