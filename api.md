# Api Documentation

This documentation is made so that users who use this application can easily operate any features that have been made in this application. You can read the list of endpoints below.

## Categories

<strong>Category List</strong>

- <b>URL</b>: `{domain}/api/v1/categories`
- <b>Params</b>: -
- <b>Method</b>: `GET`
- <b>Body</b>: -
- <b>Response</b>:
    ```
    Success response 200
    {
        data: [{
            id: number,
            name: string,
            enable: boolean,
            created_at: timstamps,
            updated_at: timstamps,
        }, {
            . . .
        }],
        meta: {
            timestamp => string,
            timezone => string,
        }
    }
    ```

<strong>Store Category</strong>

- <b>URL</b>: `{domain}/api/v1/categories`
- <b>Params</b>: -
- <b>Method</b>: `POST`
- <b>Body</b>:
  ```
  {
    "name": {
        "data_type": string,
        "rules": [
            "required",
            "max:100"
        ]
    },
    "enable": {
        "data_type": boolean,
        "default_value": false,
        "rules": [
            "nullable",
            "boolean"
        ]
    }
  }
  ```
- <b>Response</b>:
    ```
    Success response 201
    {
        "data": [{
            "id": number,
            "name": string,
            "enable": boolean,
            "created_at": timstamps,
            "updated_at": timstamps,
        }, {
            . . .
        }],
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }

    Failed response 422
    {
        "data": {
            "[field_name]": [string],
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }
    ```

<strong>Show Category</strong>

- <b>URL</b>: `{domain}/api/v1/categories/find/{id}`
- <b>Params</b>: id: int `Category ID`
- <b>Method</b>: `GET`
- <b>Body</b>: -
- <b>Response</b>:
    ```
    Success response 200
    {
        "data": {
            "id": number,
            "name": string,
            "enable": boolean,
            "created_at": timstamps,
            "updated_at": timstamps,
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }
    ```

    Failed response 404
     {
        "data": {
            "errors": {
                "message": string
            }
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }
<strong>Update Category</strong>

- <b>URL</b>: `{domain}/api/v1/categories/{id}`
- <b>Params</b>: id: int `Category ID`
- <b>Method</b>: `PATCH`
- <b>Body</b>:
  ```
  {
    "name": {
        "data_type": string,
        "rules": [
            "required",
            "max:100"
        ]
    },
    "enable": {
        "data_type": boolean,
        "default_value": false,
        "rules": [
            "nullable",
            "boolean"
        ]
    }
  }
  ```
- <b>Response</b>:
    ```
    Success response 200
    {
        "data": {
            "id": number,
            "name": string,
            "enable": boolean,
            "created_at": timstamps,
            "updated_at": timstamps,
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }

    Failed response 422
    {
        "data": {
            "[field_name]": [string],
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }
    ```

<strong>Delete Category</strong>

- <b>URL</b>: `{domain}/api/v1/categories`
- <b>Params</b>: -
- <b>Method</b>: `DELETE`
- <b>Body</b>:
  ```
  {
    "category_id": int
  }
  ```
- <b>Response</b>:
    ```
    Success response 200
    {
        "data": {
            "message": string,
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }

    Failed response 400 (entity can't be deleted)
     {
        "data": {
            "errors": string,
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }

    Failed response (Entity not found)
    Failed response 422
     {
        "data": {
            "errors": [
                "category_id": [string]
            ]
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }
    ```

## Products

<strong>Product List</strong>

- <b>URL</b>: `{domain}/api/v1/products`
- <b>Params</b>: -
- <b>Method</b>: `GET`
- <b>Body</b>: -
- <b>Response</b>:
    ```
    Success response 200
    {
        "data": [{
            "id": number,
            "name": string,
            "description": boolean,
            "created_at": timstamps,
            "updated_at": timstamps,
            "categories": [object] <category object>,
            "images": [object] <image object>
        }, {
            . . .
        }],
        meta: {
            "timestamp" => string,
            "timezone" => string,
        }
    }
    ```
<strong>Store Product</strong>

- <b>URL</b>: `{domain}/api/v1/products`
- <b>Params</b>: -
- <b>Method</b>: `POST`
- <b>Body</b>:
  ```
  {
    "name": {
        "data_type": string,
        "rules": [
            "required",
            "max:100"
        ]
    },
    "description": {
        "data_type": string,
        "rules": [
            "required",
        ]
    },
    "images": {
        "data_type": array,
        "rules": ['nullable', 'array', 'filled']
    },
    "images.*" => {
        "data_type": object,
        "rules": ['image']
    },
    "categories" => {
        "data_type": array,
        "rules": ['required', 'array']
    },
    "categories.*"" => {
        "data_type": int,
        "rules": ['exists:categories,id']
    },
    "enable": {
        "data_type": boolean,
        "default_value": false,
        "rules": [
            "nullable",
            "boolean"
        ]
    }
  }
  ```
- <b>Response</b>:
    ```
    Success response 201
    {
        "data": [{
            "id": number,
            "name": string,
            "enable": boolean,
            "created_at": timstamps,
            "updated_at": timstamps,
        }, {
            . . .
        }],
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }

    Failed response 422
    {
        "data": {
            "[field_name]": [string],
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }
    ```

<strong>Show Product</strong>

- <b>URL</b>: `{domain}/api/v1/products/find/{id}`
- <b>Params</b>: id: int `Product ID`
- <b>Method</b>: `GET`
- <b>Body</b>: -
- <b>Response</b>:
    ```
    Success response 200
    {
        "data": {
            "id": number,
            "name": string,
            "description": boolean,
            "created_at": timstamps,
            "updated_at": timstamps,
            "categories": [object] <category object>,
            "images": [object] <image object>
        },,
        "meta": {
            "timestamp": string,
            "timezone": stirng
        }
    }
    ```
 
 <strong>Update Category</strong>

- <b>URL</b>: `{domain}/api/v1/categories/{id}`
- <b>Params</b>: id: int `Category ID`
- <b>Method</b>: `PATCH`
- <b>Body</b>:
  ```
  {
    "name": {
        "data_type": string,
        "rules": [
            "required",
            "max:100"
        ]
    },
    "description": {
        "data_type": string,
        "rules": [
            "required",
        ]
    },
    "images": {
        "data_type": array,
        "rules": ['nullable', 'array', 'filled']
    },
    "images.*" => {
        "data_type": object,
        "rules": ['image']
    },
    "categories" => {
        "data_type": array,
        "rules": ['required', 'array']
    },
    "categories.*"" => {
        "data_type": int,
        "rules": ['exists:categories,id']
    },
    "enable": {
        "data_type": boolean,
        "default_value": false,
        "rules": [
            "nullable",
            "boolean"
        ]
    }
  }
  ```
- <b>Response</b>:
    ```
    Success response 200
    {
        "data": {
            "id": number,
            "name": string,
            "enable": boolean,
            "created_at": timstamps,
            "updated_at": timstamps,
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }

    Failed response 422
    {
        "data": {
            "[field_name]": [string],
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }
    ```

<strong>Delete Product</strong>

- <b>URL</b>: `{domain}/api/v1/products`
- <b>Params</b>: -
- <b>Method</b>: `DELETE`
- <b>Body</b>:
  ```
  {
    "product_id": int
  }
  ```
- <b>Response</b>:
    ```
    Success response 200
    {
        "data": {
            "message": string,
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }

    Failed response 400 (entity can't be deleted)
     {
        "data": {
            "errors": string,
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }

    Failed response (Entity not found)
    Failed response 422
     {
        "data": {
            "errors": [
                "product_id": [string]
            ]
        },
        "meta": {
            "timestamp": string,
            "timezone" => string,
        }
    }
    ```