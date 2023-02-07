import useJwt from '../../libs/jwt/useJwt'
import axios from 'axios'

const { jwt } = useJwt(axios, {})
export default jwt
