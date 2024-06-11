#include <iostream>
#include <vector>

using namespace std;

// Struktur untuk menyimpan titik pada grid
struct Point {
  int x, y;
  Point(int x, int y) : x(x), y(y) {}

  // Overload operator untuk menambahkan dua titik
  Point operator+(const Point& other) const {
    return Point(x + other.x, y + other.y);
  }

  // Overload operator untuk membagi titik dengan skalar
  Point operator/(int divisor) const {
    return Point(x / divisor, y / divisor);
  }
};

// Struktur untuk menyimpan grid N x N
struct Grid {
  int N;
  vector<vector<int>> grid;
  Grid(int N, int M) : N(N) {
    grid.resize(N, vector<int>(M));
  }

  // Fungsi untuk memilih titik acak pada grid
  vector<Point> randomPoints(int numPoints) {
    vector<Point> points;
    for (int i = 0; i < numPoints; i++) {
      points.push_back(Point(rand() % N, rand() % N));
    }
    return points;
  }
};

// Fungsi untuk menentukan apakah titik tengah gar
