# Build stage
FROM hugomods/hugo:base AS builder
WORKDIR /src
COPY . .
ARG APP_ENV
RUN hugo --environment ${APP_ENV} --minify

# Final stage
FROM nginx:alpine
COPY --from=builder /src/public /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
