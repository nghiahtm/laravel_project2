<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RegisterFormRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserDetailResource;
use App\Http\Resources\V1\UserRegisterResource;
use App\Models\AuthModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $credentials = request(['email', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'account or password is incorrect',"status"=>'401'], 401);
        }
        $refreshToken = $this->setRefreshToken();
        return $this->respondWithToken($token,$refreshToken);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function setRefreshToken(){
        $data = [
            "user_id"=> auth()->user()->id,
            "random"=> rand().time(),
            "exp"=> time()+config("jwt.refresh_ttl")
        ];
        return JWTAuth::getJWTProvider()->encode($data);
    }
    public function getUser()
    {
        $user = auth()->user();
        $userRes = new UserDetailResource($user);

        return $this->sentSuccessResponse($userRes);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        //try {
            auth()->logout(true);
            return $this->sentSuccessResponse(null,"Successfully logged out");
//        }catch (ExceptionNotFound $exception){
//            return response()->json(['message' => $exception->getMessage()]);
//        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $refreshToken = request()->refresh_token;
        try{
            $decodeToken = JWTAuth::getJWTProvider()->decode($refreshToken);
            $users = User::all();
            $user = $users->find($decodeToken['sub_id']);
            if(!$user){
                return response()->json(['error'=>"user not found"],404);
            }
            auth()->invalidate();
            $newToken = auth()->login($user);
            $refresh = $this->setRefreshToken();
            return $this->respondWithToken($newToken,$refresh);

        }catch (JWTException $exception){
            return response()->json(["error"=>"refresh token in valid"],500);
        }
    }

    public function register(RegisterFormRequest $request)
    {
        $requestForm = $request->only([
            "name","email","confirm_password","password","phone_number"
        ]);

       $user= User::create($requestForm);
      $newToken = auth()->login($user);
          $refresh = $this->setRefreshToken();
        $collection = collect($requestForm);
        $newCollectUser=$collection->union(["token" =>  ["refresh_token"=> $refresh,
            "access_token"=> $newToken,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60]]);
        $userRes = new UserRegisterResource($newCollectUser);
        return $this->sentSuccessResponse($userRes);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $requestForm = $request->only([
            "name","email","genders","roles","address"
        ]);
        $user = $request->user();
        $user->name = $requestForm['name'];
        $user->email = $requestForm['email'];
        $user->genders = $requestForm['genders'];
        $user->address = $requestForm['address'];
        $user->save();
          return $this->sentSuccessResponse(null,"updated successfully");
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token,$refresh_token)
    {
        return response()->json([
            'access_token' => $token,
            "refresh_token"=> $refresh_token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(AuthModel $authModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AuthModel $authModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuthModel $authModel)
    {
        //
    }
}
