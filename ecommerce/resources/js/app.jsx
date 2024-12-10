import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Welcome from './Pages/Welcome';
import ProductDetail from './Pages/ProductDetail';

export default function App() {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Welcome />} />
                <Route path="/products/:slug" element={<ProductDetail />} />
            </Routes>
        </Router>
    );
}



