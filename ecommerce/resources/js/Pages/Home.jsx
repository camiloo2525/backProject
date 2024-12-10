import React, { useEffect, useState } from 'react';
import api from '../api';

const Home = () => {
    const [categories, setCategories] = useState([]);
    const [products, setProducts] = useState([]);

    useEffect(() => {
        // Obtener categorías y productos al cargar la página
        api.get('/categories')
            .then((response) => setCategories(response.data))
            .catch((error) => console.error(error));

        api.get('/products')
            .then((response) => setProducts(response.data))
            .catch((error) => console.error(error));
    }, []);

    return (
        <div>
            <h1>Welcome to the E-commerce Platform</h1>
            <section>
                <h2>Categories</h2>
                <ul>
                    {categories.map((category) => (
                        <li key={category.id}>
                            <a href={`/categories/${category.slug}`}>
                                {category.name}
                            </a>
                        </li>
                    ))}
                </ul>
            </section>
            <section>
                <h2>Products</h2>
                <ul>
                    {products.map((product) => (
                        <li key={product.id}>
                            <a href={`/products/${product.slug}`}>
                                {product.name}
                            </a>
                        </li>
                    ))}
                </ul>
            </section>
        </div>
    );
};

export default Home;
