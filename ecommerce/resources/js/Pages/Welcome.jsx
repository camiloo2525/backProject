import React, { useEffect, useState } from 'react';
import axios from 'axios';

export default function Welcome() {
    const [categories, setCategories] = useState([]);
    const [products, setProducts] = useState([]);

    useEffect(() => {
        axios
            .get('/api/categories')
            .then((response) => {
                setCategories(response.data);
            })
            .catch((error) => {
                console.error('Error fetching categories:', error);
            });

        axios
            .get('/api/products')
            .then((response) => {
                setProducts(response.data);
            })
            .catch((error) => {
                console.error('Error fetching products:', error);
            });
    }, []);

    return (
        <div>
            <h1>Productos Disponibles</h1>
            <div>
                <h2>Categorías</h2>
                {categories.map((category) => (
                    <div key={category.id}>
                        <h3>{category.name}</h3>
                        <p>{category.description}</p>
                    </div>
                ))}
            </div>
            <div>
                <h2>Productos</h2>
                {products.map((product) => (
                    <div key={product.id}>
                        <h3>{product.name}</h3>
                        <p>{product.description}</p>
                        <p>Categoría: {product.category?.name}</p>
                    </div>
                ))}
            </div>
        </div>
    );
}


