import React, { useEffect, useRef } from 'react';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

export default function FinancialCharts({ incomeData, expenseData }) {
    const incomeChartRef = useRef(null);
    const expenseChartRef = useRef(null);

    useEffect(() => {
        if (incomeChartRef.current && incomeData) {
            const ctx = incomeChartRef.current.getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: incomeData.labels,
                    datasets: [{
                        label: 'Income',
                        data: incomeData.values,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        if (expenseChartRef.current && expenseData) {
            const ctx = expenseChartRef.current.getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: expenseData.labels,
                    datasets: [{
                        data: expenseData.values,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        }
    }, [incomeData, expenseData]);

    return (
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="bg-white p-4 rounded-lg shadow">
                <h3 className="text-lg font-semibold mb-4">Income Overview</h3>
                <canvas ref={incomeChartRef}></canvas>
            </div>
            <div className="bg-white p-4 rounded-lg shadow">
                <h3 className="text-lg font-semibold mb-4">Expense Breakdown</h3>
                <canvas ref={expenseChartRef}></canvas>
            </div>
        </div>
    );
} 