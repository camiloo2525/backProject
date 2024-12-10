import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';

export default function ProductDetail() {
    const { slug } = useParams();
    const [product, setProduct] = useState(null);

    useEffect(() => {
        axios.get(`/api/products/${slug}`).then((response) => {
            setProduct(response.data);
        });
    }, [slug]);

    if (!product) {
        return <p>Cargando...</p>;
    }

    return (
        <div>
            <h1>{product.name}</h1>
            <p>{product.description}</p>
            <p>Categoría: {product.category.name}</p>
        </div>
    );
}
