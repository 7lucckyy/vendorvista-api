<?php 
public function handle(CreateStoreRequest $request){
    $vendorID = auth()->id();
    $validatedRequest = $request->validated();

    DB::transaction(function () use($validatedRequest, $vendorID) {
        $store = $this->storeActions->createStoreRecord([
           'store_payload' => [
                'store_name' => $validatedRequest['store_name'],
                'business_type' => $validatedRequest['business_type'],
                'is_registered' => $validatedRequest['is_registered'],
                'cac_number' => $validatedRequest['cac_number'],
                'business_address' => $validatedRequest['business_address'],
                'vendor_id' => $vendorID

           ],
        ]);
        
        return successResponse(
            'Store record was created successfully',
            201,
        );
    });